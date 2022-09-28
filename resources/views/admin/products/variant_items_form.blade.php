<input type="hidden" value="{{ $variant_key_values }}" id="variant_key_values">

@foreach ($all_combination as $index => $variant)
    <div class="tflex tjustify-between titems-center tpx-5 tborder-b tpy-3 variant-row" deleted="false">
        <div class="ttext-black-100 ttext-sm tmr-3 tw-32">
            <span class="name">{{ $variant }}</span>
        </div>
        <div class="ttext-black-100 ttext-sm tmr-3">
            <input type="number" class="browser-default form-control price" onkeyup="allnumeric(this)" style="padding: 6px; font-size: 14px;">
        </div>
        <div class="ttext-black-100 ttext-sm tmr-3">
            <input type="number" class="browser-default form-control qty" onkeyup="allnumeric(this)" style="padding: 6px; font-size: 14px;">
        </div>
        <div class="ttext-black-100 ttext-sm tmr-3">
            <input type="text" class="browser-default form-control sku" style="padding: 6px; font-size: 14px;">
        </div>
        <div class="ttext-black-100 ttext-sm">
            <input type="text" class="browser-default form-control barcode" style="padding: 6px; font-size: 14px;">
        </div>

        <div class="ttext-black-100 ttext-sm tmr-3 tpy-1 thidden variant_deleted_text">
            <p>This variant will not be created</p>
        </div><!-- show if the variant will not be included -->

        <div class="tflex titems-center tpl-4 ttext-black-100 ttext-sm">
            <span style="color:#006fbb;" class="hover:tunderline tcursor-pointer ttext-blue thidden undo_delete_variant">Undo</span>
            <i class="far fa-trash-alt hover:ttext-red-500 tooltipped delete_variant"  data-position="bottom" data-tooltip="delete variant" style="font-size: 20px;"></i>
        </div>
    </div>
@endforeach

<script>
    $('.delete_variant').click(function() {
        $(this).hide();
        $(this).prev().show();
        $(this).parent().prev().show();
        $(this).parent().prev().prev().hide(); // Barcode
        $(this).parent().prev().prev().prev().hide(); // SKU
        $(this).parent().prev().prev().prev().prev().hide(); // Quantity
        $(this).parent().prev().prev().prev().prev().prev().hide(); // Price
        $(this).parent().parent().attr('deleted', 'true'); // set the variant row as deleted
    })

    $('.undo_delete_variant').click(function () {
        $(this).hide();
        $(this).next().show();
        $(this).parent().prev().hide();
        $(this).parent().prev().prev().show();// Barcode
        $(this).parent().prev().prev().prev().show(); // SKU
        $(this).parent().prev().prev().prev().prev().show(); // Quantity
        $(this).parent().prev().prev().prev().prev().prev().show(); // Price
        $(this).parent().parent().attr('deleted', 'false'); // set the variant row as not deleted
    })
</script>