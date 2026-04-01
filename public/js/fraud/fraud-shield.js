(function (global) {
    'use strict';

    function deepMerge(target, source) {
        var output = target || {};
        var key;

        if (!source || typeof source !== 'object') {
            return output;
        }

        for (key in source) {
            if (!Object.prototype.hasOwnProperty.call(source, key)) {
                continue;
            }

            if (source[key] && typeof source[key] === 'object' && !Array.isArray(source[key])) {
                output[key] = deepMerge(output[key] || {}, source[key]);
            } else {
                output[key] = source[key];
            }
        }

        return output;
    }

    function getDefaultConfig() {
        return {
            website: global.location && global.location.hostname ? global.location.hostname : null,
            sessionId: null,
            fingerprintCdn: 'https://openfpcdn.io/fingerprintjs/v5',
            storageKey: 'order_control',
            localSessionStorageKey: 'session_id',
            endpoints: {
                checkBlock: '/order-signal/check-block-user',
                collectSignal: '/order-signal'
            },
            selectors: {
                fullName: '#full_name',
                phoneNumber: '#phone_number'
            },
            popup: {
                enabled: true,
                title: 'Unusual Activity Detected',
                message: 'We detected an unsual activity. If you still want to order, click the button below.',
                buttonText: 'Order in Messenger',
                buttonLink: 'https://m.me/262215796983675'
            },
            lockRules: {
                maxSamePromoPerDay: 1,
                maxTotalPerDay: 3,
                lockDays: 3
            },
            debug: false,
            autoShowPopupOnBlocked: true
        };
    }

    function FraudShield(options) {
        this.config = deepMerge(getDefaultConfig(), options || {});
        this.fpPromise = null;
        this.visitorPromise = null;
        this.readyPromise = null;
        this.fingerprintjsVisitorId = null;
        this.isFingerprintBlocked = false;
        this.popupId = 'fraud-blocked-popup-overlay';
    }

    FraudShield.prototype.log = function () {
        if (!this.config.debug) {
            return;
        }
        var args = Array.prototype.slice.call(arguments);
        args.unshift('[FraudShield]');
        if (global.console && typeof global.console.log === 'function') {
            global.console.log.apply(global.console, args);
        }
    };

    FraudShield.prototype.getCsrfToken = function () {
        var node = global.document.querySelector('meta[name="csrf-token"]');
        return node ? node.getAttribute('content') : '';
    };

    FraudShield.prototype.readValue = function (selector) {
        if (!selector) {
            return null;
        }

        if (global.jQuery && typeof global.jQuery === 'function') {
            var jq = global.jQuery(selector);
            if (jq.length) {
                return jq.val() || null;
            }
        }

        var node = global.document.querySelector(selector);
        if (!node) {
            return null;
        }

        return node.value || null;
    };

    FraudShield.prototype.getQueryParam = function (name) {
        try {
            var urlParams = new URLSearchParams(global.location.search || '');
            return urlParams.get(name) || null;
        } catch (e) {
            return null;
        }
    };

    FraudShield.prototype.getDeviceType = function () {
        var ua = (global.navigator.userAgent || '').toLowerCase();
        if (/mobile/.test(ua)) {
            return 'mobile';
        }
        if (/tablet/.test(ua)) {
            return 'tablet';
        }
        return 'desktop';
    };

    FraudShield.prototype.getSimpleFingerprint = function () {
        try {
            return [
                global.navigator.userAgent,
                global.screen.width,
                global.screen.height,
                global.navigator.language,
                new Date().getTimezoneOffset()
            ].join('|');
        } catch (e) {
            return null;
        }
    };

    FraudShield.prototype.getLocalSessionId = function () {
        var key = this.config.localSessionStorageKey;
        try {
            var sessionId = global.localStorage.getItem(key);
            if (!sessionId) {
                sessionId = 'sess_' + Math.random().toString(36).slice(2) + Date.now();
                global.localStorage.setItem(key, sessionId);
            }
            return sessionId;
        } catch (e) {
            return null;
        }
    };

    FraudShield.prototype.loadFingerprintJS = function () {
        var self = this;

        if (!this.fpPromise) {
            this.fpPromise = import(this.config.fingerprintCdn)
                .then(function (FingerprintJS) {
                    return FingerprintJS.load();
                })
                .catch(function (error) {
                    self.log('Failed to load FingerprintJS', error);
                    throw error;
                });
        }

        return this.fpPromise;
    };

    FraudShield.prototype.getFingerprintVisitorId = function () {
        var self = this;

        return this.loadFingerprintJS()
            .then(function (fp) {
                return fp.get();
            })
            .then(function (result) {
                return (result && result.visitorId) ? result.visitorId : null;
            })
            .catch(function (error) {
                self.log('Fingerprint visitor id error', error);
                return null;
            });
    };

    FraudShield.prototype.initFingerprintVisitorId = function () {
        var self = this;

        if (!this.visitorPromise) {
            this.visitorPromise = this.getFingerprintVisitorId()
                .then(function (id) {
                    self.fingerprintjsVisitorId = id;
                    return id;
                })
                .catch(function () {
                    return null;
                });
        }

        return this.visitorPromise;
    };

    FraudShield.prototype.postJSON = function (url, payload) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.getCsrfToken()
            },
            credentials: 'same-origin',
            body: JSON.stringify(payload || {})
        });
    };

    FraudShield.prototype.checkFingerprintBlockStatus = function (id) {
        var self = this;

        if (!id) {
            return Promise.resolve(false);
        }

        return this.postJSON(this.config.endpoints.checkBlock, {
            fingerprintjs_visitor_id: id
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                return !!(data && data.blocked);
            })
            .catch(function (error) {
                self.log('check block status failed', error);
                return false;
            });
    };

    FraudShield.prototype.ensureBlockedPopup = function () {
        var overlay = global.document.getElementById(this.popupId);
        var popup = this.config.popup;

        if (overlay) {
            return overlay;
        }

        overlay = global.document.createElement('div');
        overlay.id = this.popupId;
        overlay.style.position = 'fixed';
        overlay.style.inset = '0';
        overlay.style.background = 'rgba(15, 23, 42, 0.7)';
        overlay.style.display = 'none';
        overlay.style.alignItems = 'center';
        overlay.style.justifyContent = 'center';
        overlay.style.zIndex = '99999';
        overlay.style.padding = '16px';

        overlay.innerHTML = [
            '<div style="width:100%;max-width:420px;background:#fff;border-radius:14px;box-shadow:0 20px 40px rgba(0,0,0,.25);padding:24px 20px 20px;text-align:center;">',
            '<h3 style="margin:0 0 8px;color:#991b1b;font-size:22px;font-weight:700;">' + popup.title + '</h3>',
            '<p style="margin:0 0 16px;color:#334155;font-size:14px;line-height:1.5;">' + popup.message + '</p>',
            '<a href="' + popup.buttonLink + '" target="_blank" rel="noopener noreferrer" style="display:inline-block;background:#1877f2;color:#fff;text-decoration:none;border-radius:10px;padding:10px 14px;font-size:14px;font-weight:700;">' + popup.buttonText + '</a>',
            '</div>'
        ].join('');

        global.document.body.appendChild(overlay);
        return overlay;
    };

    FraudShield.prototype.showBlockedPopup = function () {
        if (!this.config.popup.enabled) {
            return;
        }

        var overlay = this.ensureBlockedPopup();
        overlay.style.display = 'flex';
    };

    FraudShield.prototype.hideBlockedPopup = function () {
        var overlay = global.document.getElementById(this.popupId);
        if (overlay) {
            overlay.style.display = 'none';
        }
    };

    FraudShield.prototype.init = function () {
        var self = this;

        if (!this.readyPromise) {
            this.readyPromise = this.initFingerprintVisitorId()
                .then(function (id) {
                    self.log('Fingerprint Visitor ID:', id);
                    return self.checkFingerprintBlockStatus(id);
                })
                .then(function (blocked) {
                    self.isFingerprintBlocked = blocked;
                    global.isFingerprintBlocked = blocked;
                    self.log('Fingerprint Blocked:', blocked);

                    if (blocked && self.config.autoShowPopupOnBlocked) {
                        self.showBlockedPopup();
                    }

                    return {
                        fingerprintjs_visitor_id: self.fingerprintjsVisitorId,
                        blocked: blocked
                    };
                });
        }

        return this.readyPromise;
    };

    FraudShield.prototype.collectSignalData = function (custom) {
        var extra = custom || {};

        var basePayload = {
            website: this.config.website,
            session_id: this.config.sessionId,
            local_session_id: this.getLocalSessionId(),
            fingerprintjs_visitor_id: this.fingerprintjsVisitorId,
            full_name: this.readValue(this.config.selectors.fullName),
            phone_number: this.readValue(this.config.selectors.phoneNumber),
            promo: extra.promo || extra.promo_name || null,
            fbclid: this.getQueryParam('fbclid'),
            utm_campaign: this.getQueryParam('utm_campaign'),
            utm_content: this.getQueryParam('utm_content'),
            utm_medium: this.getQueryParam('utm_medium'),
            fingerprint: this.getSimpleFingerprint(),
            device_type: this.getDeviceType(),
            user_agent: global.navigator.userAgent || null,
            timestamp: Date.now()
        };

        return Object.assign({}, basePayload, extra);
    };

    FraudShield.prototype.sendOrderSignal = function (custom) {
        var self = this;
        var payload = this.collectSignalData(custom);

        this.log('Order signal payload:', payload);

        return this.postJSON(this.config.endpoints.collectSignal, payload)
            .then(function (response) {
                return response.json().catch(function () {
                    return { status: response.ok };
                });
            })
            .catch(function (error) {
                self.log('sendOrderSignal failed', error);
                return { status: false };
            });
    };

    FraudShield.prototype.validateAndRecordOrder = function (promo) {
        var domain = this.config.website || (global.location && global.location.hostname) || 'default';
        var today = new Date().toISOString().slice(0, 10);
        var rules = this.config.lockRules;

        function getStorage(storageKey) {
            try {
                return JSON.parse(global.localStorage.getItem(storageKey) || '{}');
            } catch (e) {
                return {};
            }
        }

        function saveStorage(storageKey, data) {
            global.localStorage.setItem(storageKey, JSON.stringify(data));
        }

        var allData = getStorage(this.config.storageKey);

        if (!allData[domain]) {
            allData[domain] = {};
        }

        if (!allData[domain][today]) {
            allData[domain][today] = {
                total: 0,
                promos: {}
            };
        }

        var dayData = allData[domain][today];

        if (dayData.locked_until && new Date() < new Date(dayData.locked_until)) {
            return false;
        }

        if ((dayData.promos[promo] || 0) >= rules.maxSamePromoPerDay) {
            return false;
        }

        if (dayData.total >= rules.maxTotalPerDay) {
            return false;
        }

        dayData.promos[promo] = (dayData.promos[promo] || 0) + 1;
        dayData.total += 1;

        if (dayData.total >= rules.maxTotalPerDay) {
            var lockDate = new Date();
            lockDate.setDate(lockDate.getDate() + rules.lockDays);
            dayData.locked_until = lockDate.toISOString();
        }

        saveStorage(this.config.storageKey, allData);
        return true;
    };

    FraudShield.prototype.guardSubmitIfBlocked = function (event) {
        if (!this.isFingerprintBlocked) {
            return true;
        }

        if (event && typeof event.preventDefault === 'function') {
            event.preventDefault();
        }

        this.showBlockedPopup();
        return false;
    };

    FraudShield.prototype.getState = function () {
        return {
            fingerprintjs_visitor_id: this.fingerprintjsVisitorId,
            blocked: this.isFingerprintBlocked
        };
    };

    global.FraudShield = {
        create: function (options) {
            return new FraudShield(options || {});
        }
    };
})(window);
