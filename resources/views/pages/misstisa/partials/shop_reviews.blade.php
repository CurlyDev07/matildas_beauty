@php
    // Display names are pseudonyms, consistently reused for repeat reviewers.
    // Replace avatar and photo slots with image URLs when the customer photos are ready.
    // Dates remain as shown in the screenshots; missing years are not inferred.
    $shopReviews = [
        ['name' => 'Jessa Santos', 'stars' => 5, 'date' => '1-31', 'likes' => 4, 'photos' => ["https://matildasbeauty.com/filemanager/110e647ab1834f79a3116869f61519d6.webp", "https://matildasbeauty.com/filemanager/9509e463a4ad4d0085910ee761777163.webp"], 'comment' => "I super love the soap (mild+milky)\nHindi mahapdi\nIts my 3rd night and my skin become smooth and brighten already."],
        ['name' => 'Rochelle Cruz', 'stars' => 5, 'date' => '2025-12-18', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/ee6990bdd2e44d0f9b698508db566e88.webp", "https://matildasbeauty.com/filemanager/9fe2c8fcf92d45f7b163a3e8c5ccfa0e.webp"], 'comment' => 'Bilis nya dumting prng kaorder ko lng khapon..triny q agad sabon plng rmdam q effctiveness nya dhl prng kinukutkot ung balat..pgkabanlaw prng ang gnd agad..tps ngtoner aq..as in kht bgong hilamos nttngl ung dirt s mkha q..sbay ngcream.thank u seller mkhang mpapaorder ule aq..legit sya'],
        ['name' => 'Queenie Reyes', 'stars' => 5, 'date' => '2-25', 'likes' => 1, 'photos' => ["https://matildasbeauty.com/filemanager/c1642fb2cdf8426496cfceca8baa57f7.webp", "https://matildasbeauty.com/filemanager/f67f4d0d04424972b444923709e0bfff.webp"], 'comment' => 'Ngayong lang ako nag submit ng review kasi ginamit ko Mona Pero super ganda nya sa face ko di CIA nagbabalat Pero kitang kita na pumuti mukha ko thank you seller order ulit ako kapag malapit na...', 'truncated' => true],
        ['name' => 'Rochelle Cruz', 'stars' => 5, 'date' => '2-24', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/f458255365794a3fa24bf3bebd1408c6.webp", "https://matildasbeauty.com/filemanager/2bdbf457d9d9446987569697c85ac8bb.webp"], 'comment' => '2nd tym n order q na to and legit sya nkaka tnggl ng melasma..mbilis p dumating ...oorder ule aq pgkaubos at sna cream lng meron kasi un unang nauubos sken'],
        ['name' => 'Amy Garcia', 'stars' => 5, 'date' => '3-28', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/c31c5283a72641988fd5043d8d89e6ee.webp", "https://matildasbeauty.com/filemanager/a89cc1b376c544f79c4f50f6b0a27288.webp"], 'comment' => 'Ang Ganda Niya..dati Akala ko di sya effective after 1 mos. Of using ngfade na Ang melasma ko.i highly recommended misstissa'],
        ['name' => 'Evelyn Ramos', 'stars' => 5, 'date' => '1-30', 'likes' => 1, 'photos' => ["https://matildasbeauty.com/filemanager/b78cdddf5db546a0ac64c03831fda1cc.webp"], 'comment' => 'Thankyou seller gustong gusto Po ng aunt.ko gamitin Ang product na ito.hiyang na hiyang sa kanya look younger at the age of 80 this year..parang nasa 65 lang Ang edad..younger looks.'],
        ['name' => 'Christine Mendoza', 'stars' => 5, 'date' => '2-7', 'likes' => 5, 'photos' => ["https://matildasbeauty.com/filemanager/c555fce110294bbba690f012e93bee7c.webp"], 'comment' => 'Maganda sya gamitin nd gano nagbabalat at hindi mahapdi nagustuhan ko sya gamitin pero nd pa gano effective sa face ko pero umorder ulit ako kasi 1 week plng naman ginagamit natuyo na tagyawat ko ,sana lng mawala ung mga spot ng tagyawat'],
        ['name' => 'Maria Lourdes Aquino', 'stars' => 5, 'date' => '4-5', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/fe7dc2ecca2d42c7b50e56b874fef9c7.webp", "https://matildasbeauty.com/filemanager/70cb720b2db047ebaa822b32706efe53.webp"], 'comment' => 'Sobrang ganda 2 days kuna gamit nkikita kuna nag glow ung skin ko nag try muna ako baka mag review hehe para sure mild lng sya di mahapdi sa balat pero kita muna agad'],
        ['name' => 'Jenny Dela Cruz', 'stars' => 5, 'date' => '2-18', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/20b3735f3ad74345a4055b0a65eee9bd.webp", "https://matildasbeauty.com/filemanager/71376c26c4f64bec9a086c3518f006c2.webp"], 'comment' => 'good c9ndition ng dumating..well packaging din..safe na safe..sna effective sken..problematic nko sa melasma ko..😊 😊'],
        ['name' => 'Sheryl Mae Flores', 'stars' => 4, 'date' => '2-16', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/78181dab700c4d9a9f102ceb9666617f.webp"], 'comment' => 'Pang 5th day ko pa . Peru infairness medyo nag lighten na yung melasma ko.. sana mas mu lighten pa talaga 🙏 dami ko na nagamit na product .. 🥺sana eto na talaga..'],
        ['name' => 'Hazel Bautista', 'stars' => 4, 'date' => '2025-10-28', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/9719ebb37b224924a134e60b0f84f393.webp"], 'comment' => 'Natry kona xa,maganda medyo nagligth ang pekas ko,hoping pag maubos ko may maganda result pa..oorder ako uli if may maganda result pa..salamat seller ang rider ang bilis dumating'],
        ['name' => 'Nina Alonzo', 'stars' => 5, 'date' => '2025-9-8', 'likes' => 0, 'photos' => ["https://matildasbeauty.com/filemanager/444da3e2593b4cf8b20485b7e6ac61f6.webp"], 'comment' => 'Order received, second time of purchasing Effective talaga sa akin sakto paubos na ngayong Ang una kaya magagamit Kuna itong dumating. Thank you so much seller 🫶', 'reply' => 'thank you po'],
        ['name' => 'Joyce Villanueva', 'stars' => 5, 'date' => '3-10', 'likes' => 4, 'photos' => ["https://matildasbeauty.com/filemanager/51c0ae3bd8f545b4a7cb602872d72c77.webp"], 'comment' => 'Super ganda Ng misstisa 6 na araw oa akong gumamit nagfade na melasma ko Ang ikinagaga da sa product is ndi nagbakbak at di mahapdi tsaka di namumula face ko Kaya order ulit ako nito'],
        ['name' => 'Rose Dizon', 'stars' => 5, 'date' => '2-5', 'likes' => 1, 'photos' => ["https://matildasbeauty.com/filemanager/52194f3c23694b67ba169b2853ad5189.webp"], 'comment' => "It's good on my face and now becoming smooth and glowing rally satisfied"],
    ];
    $shopReviewAverage = collect($shopReviews)->avg('stars');
@endphp

<style>
    .mt-shop-reviews { background:#fff8fb;color:#201827;padding:28px 18px 36px;font-family:Arial,sans-serif;text-align:left;border-top:3px solid #ff0060; }
    .mt-shop-reviews * { box-sizing:border-box;letter-spacing:0; }
    .mt-shop-reviews .mt-review-heading { margin:0;font-size:23px;line-height:1.3;font-weight:700;color:#d50050; }
    .mt-review-overview { display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px; }
    .mt-review-overview small { color:#777;font-size:13px; }
    .mt-review-score { white-space:nowrap;font-size:17px;font-weight:700;color:#c9004c; }
    .mt-review-score i,.mt-review-rating { color:#f40167; }
    .mt-review-filters { display:flex;gap:8px;overflow-x:auto;padding:0 0 16px;scrollbar-width:thin; }
    .mt-review-filter { flex-shrink:0;border:1px solid #f7c8db;border-radius:6px;background:#fff;color:#a91d52;padding:8px 12px;font:inherit;font-size:12px;cursor:pointer;transition:background .15s,border-color .15s; }
    .mt-review-filter:hover { background:#ffe8f1;border-color:#f40167; }
    .mt-review-filter[aria-pressed="true"] { border-color:#df0054;background:#df0054;color:#fff; }
    .mt-review-filter i { color:inherit; }
    .mt-review-filter:focus-visible { outline:2px solid #ff0060;outline-offset:3px; }
    .mt-shop-review { padding:21px 0;border-top:1px solid #f4cedd; }
    .mt-review-person { display:flex;align-items:center;gap:10px; }
    .mt-review-avatar { display:flex;align-items:center;justify-content:center;width:36px;height:36px;flex-shrink:0;border-radius:50%;background:#ffe2ed;color:#d9467d;overflow:hidden;border:1px solid #fac0d5; }
    .mt-review-avatar img { width:100%;height:100%;object-fit:cover; }
    .mt-review-name { font-size:14px;font-weight:700;line-height:1.4;overflow-wrap:anywhere; }
    .mt-review-meta { display:flex;align-items:center;flex-wrap:wrap;gap:7px;margin-top:3px; }
    .mt-review-rating { display:inline-flex;gap:2px;font-size:13px; }
    .mt-review-rating .far { color:#e9b7c9; }
    .mt-review-item { color:#888;font-size:12px; }
    .mt-shop-reviews .mt-review-comment { margin:14px 0 0;font-size:15px;line-height:1.65;font-weight:400;white-space:pre-line;overflow-wrap:anywhere; }
    .mt-review-photos { display:flex;gap:8px;margin-top:12px;flex-wrap:wrap; }
    .mt-review-photo { width:112px;height:112px;border-radius:6px;overflow:hidden;background:#fff0f6;display:flex;align-items:center;justify-content:center;color:#ce7094;border:1px solid #f4c6d8; }
    .mt-review-photo img { width:100%;height:100%;object-fit:cover; }
    .mt-review-photo i { font-size:24px; }
    .mt-review-reply { margin-top:12px;padding:12px;background:#ffe9f2;border-left:3px solid #f40167;border-radius:4px;color:#84405c;font-size:13px; }
    .mt-review-footer { display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:19px;color:#999;font-size:12px; }
    .mt-review-actions { display:flex;align-items:center;gap:22px; }
    .mt-review-static { display:inline-flex;align-items:center;gap:6px;border:0;background:transparent;padding:4px;color:#c5356b;box-shadow:none;font:inherit;cursor:default; }
    .mt-review-static i { font-size:18px; }
    .mt-review-static:hover,.mt-review-static:focus { background:transparent; }
    .mt-review-cutoff { display:block;margin-top:5px;font-size:11px;color:#999; }
    .mt-shop-review[hidden] { display:none; }
    @media(max-width:360px) { .mt-shop-reviews { padding-left:12px;padding-right:12px; } .mt-shop-reviews .mt-review-heading { font-size:20px; } .mt-review-photo { width:96px;height:96px; } }
</style>

<section class="mt-shop-reviews" id="misstisa-shop-reviews" aria-labelledby="mt-shop-review-title">
    <div class="mt-review-overview">
        <div><h2 id="mt-shop-review-title" class="mt-review-heading">Customer Reviews</h2><small>{{ count($shopReviews) }} reviews</small></div>
        <div class="mt-review-score"><i class="fas fa-star" aria-hidden="true"></i> {{ number_format($shopReviewAverage, 1) }}<small> / 5</small></div>
    </div>
    <p style="margin:0 0 14px;font-size:11px;color:#777;">Reviewer names have been changed for privacy.</p>
    <div class="mt-review-filters" aria-label="Filter reviews">
        <button type="button" class="mt-review-filter" data-shop-review-filter="all" aria-pressed="true">All ({{ count($shopReviews) }})</button>
        <button type="button" class="mt-review-filter" data-shop-review-filter="photos" aria-pressed="false"><i class="fas fa-camera" aria-hidden="true"></i> With photos ({{ collect($shopReviews)->filter(function ($review) { return count($review['photos']) > 0; })->count() }})</button>
        @foreach([5, 4] as $rating)
            <button type="button" class="mt-review-filter" data-shop-review-filter="{{ $rating }}" aria-pressed="false"><i class="fas fa-star" aria-hidden="true"></i> {{ $rating }} ({{ collect($shopReviews)->where('stars', $rating)->count() }})</button>
        @endforeach
    </div>
    <div class="mt-review-list">
        @foreach($shopReviews as $review)
            <article class="mt-shop-review" data-review-stars="{{ $review['stars'] }}" data-review-photos="{{ count($review['photos']) }}">
                <div class="mt-review-person">
                    <div class="mt-review-avatar">
                        @if(!empty($review['avatar']))
                            <img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}" loading="lazy" width="36" height="36">
                        @else
                            <i class="fas fa-user" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div>
                        <div class="mt-review-name">{{ $review['name'] }}</div>
                        <div class="mt-review-meta">
                            <span class="mt-review-rating" aria-label="{{ $review['stars'] }} out of 5 stars">@for($star = 1; $star <= 5; $star++)<i class="{{ $star <= $review['stars'] ? 'fas' : 'far' }} fa-star" aria-hidden="true"></i>@endfor</span>
                            <span class="mt-review-item">· Item: Default</span>
                        </div>
                    </div>
                </div>
                <p class="mt-review-comment">{{ $review['comment'] }}</p>
                @if(!empty($review['truncated']))<span class="mt-review-cutoff">Review continues beyond the screenshot.</span>@endif
                @if(count($review['photos']))
                    <div class="mt-review-photos">
                        @foreach($review['photos'] as $photo)
                            <div class="mt-review-photo">
                                @if($photo)<img src="{{ $photo }}" alt="Product photo from {{ $review['name'] }}" loading="lazy" width="112" height="112">@else<i class="far fa-image" aria-label="Review photo placeholder"></i>@endif
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(!empty($review['reply']))<div class="mt-review-reply"><strong>From seller:</strong> {{ $review['reply'] }}</div>@endif
                <div class="mt-review-footer">
                    <span>{{ $review['date'] }}</span>
                    <div class="mt-review-actions">
                        <span class="mt-review-static" aria-hidden="true"><i class="fas fa-ellipsis-h"></i></span>
                        <button type="button" class="mt-review-static" aria-label="{{ $review['likes'] }} likes" aria-disabled="true" title="Likes from the original review"><i class="far fa-thumbs-up" aria-hidden="true"></i>@if($review['likes'])<span>{{ $review['likes'] }}</span>@endif</button>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
<script>
(function () {
    var section = document.getElementById('misstisa-shop-reviews');
    section.querySelectorAll('[data-shop-review-filter]').forEach(function (button) {
        button.addEventListener('click', function () {
            var filter = button.getAttribute('data-shop-review-filter');
            section.querySelectorAll('[data-shop-review-filter]').forEach(function (option) {
                option.setAttribute('aria-pressed', option === button ? 'true' : 'false');
            });
            section.querySelectorAll('.mt-shop-review').forEach(function (review) {
                review.hidden = filter === 'photos' ? Number(review.getAttribute('data-review-photos')) === 0 : filter !== 'all' && review.getAttribute('data-review-stars') !== filter;
            });
        });
    });
})();
</script>
