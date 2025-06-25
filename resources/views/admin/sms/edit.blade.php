@extends('admin.sms.layouts')

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
            <div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                <div class="">Messages</div>
            </div>

            <div class="tflex tflex-wrap tp-5">
                <input type="hidden" id="id" value="{{ request()->id }}">
                <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                    <label for="message_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Message Name</label>
                    <input type="text" id="message_name" name="message_name" class="browser-default form-control" value="{{ $message['message_name'] }}" style="padding: 6px;">
                </div>
                <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                    <label for="interval" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Interval</label>
                    <input type="number" id="interval" name="interval" class="browser-default form-control" value="{{ $message['interval'] }}" style="padding: 6px;">
                </div>
                <div class="tw-full tmb-2 lg:tmb-0 tpx-1 tpb-3">
                    <label for="message" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Message</label>
                    <textarea name="message" id="message" cols="30" rows="3" class="browser-default form-control" style="padding: 6px;">{{ $message['message'] }}</textarea>
                </div>
            </div>

            <div class="ttext-right tmr-5">
                <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit">Update</button>
            </div>

        </div>
    </div>

@endsection


@section('js')

    
    <script>

        $('#submit').click(function () {
            let id = $('#id').val();

            $.post(`https://misstisa.com/api/update-sms-message/${id}`, {
                message_name: $('#message_name').val(),
                interval: $('#interval').val(),
                message: $('#message').val(),
                _token: $('meta[name="csrf-token"]').attr('content') // Optional if needed
            })
            .done(function (response) {
                M.toast({html: 'Submitted successfully', classes: 'rounded'});
                setTimeout(function () {
                    window.location.reload();
                }, 1000); // 1 second delay (optional)
            })
            .fail(function (xhr) {
                M.toast({html: 'Error submitting', classes: 'rounded'});
                setTimeout(function () {
                    window.location.reload();
                }, 1000); // 1 second delay (optional)
            });
        });

    </script>
    
@endsection