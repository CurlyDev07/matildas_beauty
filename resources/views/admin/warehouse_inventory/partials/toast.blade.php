@if(session('success') || session('error') || $errors->any())
    <div class="wi-toast-wrap">
        @if(session('success'))
            <div class="wi-toast wi-toast-success" data-wi-toast data-duration="4200">
                <i class="fas fa-check-circle"></i>
                <div>
                    <div class="tfont-bold">Success</div>
                    <div class="ttext-sm">{{ session('success') }}</div>
                </div>
                <button type="button" class="wi-toast-close" data-wi-toast-close aria-label="Close notification">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="wi-toast wi-toast-error" data-wi-toast data-duration="15000">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <div class="tfont-bold">Error</div>
                    <div class="ttext-sm">{{ session('error') }}</div>
                </div>
                <button type="button" class="wi-toast-close" data-wi-toast-close aria-label="Close notification">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
        @if($errors->any())
            <div class="wi-toast wi-toast-error" data-wi-toast data-duration="15000">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <div class="tfont-bold">Please Check</div>
                    <div class="ttext-sm">{{ $errors->first() }}</div>
                </div>
                <button type="button" class="wi-toast-close" data-wi-toast-close aria-label="Close notification">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>
    <script>
        (function () {
            function dismissToast(toast) {
                toast.classList.add('is-hiding');
                setTimeout(function () {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }

            Array.prototype.forEach.call(document.querySelectorAll('[data-wi-toast]'), function (toast) {
                var duration = parseInt(toast.getAttribute('data-duration'), 10) || 4200;
                var closeButton = toast.querySelector('[data-wi-toast-close]');

                if (closeButton) {
                    closeButton.addEventListener('click', function () {
                        dismissToast(toast);
                    });
                }

                setTimeout(function () {
                    dismissToast(toast);
                }, duration);
            });
        })();
    </script>
@endif
