@extends('admin.sms.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.9/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
            <div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                <div class="">Messages</div>
                <!-- Modal Trigger -->

                <button data-target="modal1" class="btn modal-trigger">Modal</button>

            </div>

            <div class="tflex tp-5 tjustify-center">
                <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tbody>
                        <tr class="tborder-0">
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">#</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Message Name #</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Message</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Interval</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Actions</th>
                        </tr>

                        @foreach ($messages as $message)
                            <tr>    
                                <td class="ttext-sm ttext-center tpy-1 ">{{ $message['id'] }}</td>
                                <td class="ttext-sm ttext-center tpy-1 tfont-medium">{{ $message['message_name'] }}</td>
                                <td class="tmax-w-sm tpy-1 ttext-center ttext-sm">{{ $message['message'] }}</td>
                                <td class="ttext-sm ttext-center tpy-1">{{ $message['interval'] }}</td>
                                <td class="ttext-sm ttext-center tpy-1">
                                    <button class="delete-btn" data-id="{{ $message['id'] }}">
                                        <i class="fas fa-trash tcursor-pointer ttext-lg ttext-red-500 tmr-3"></i>
                                    </button>
                                    <a href="{{ route('sms.messages.edit', ['id' => $message['id']]) }}">
                                        <i class="fas fa-pencil-alt tcursor-pointer ttext-lg ttext-green-500"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
                        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                            Customer Info
                        </div>
                        <div class="tflex tflex-wrap tpx-5">
                            <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                                <label for="message_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Message Name</label>
                                <input type="text" id="message_name" name="message_name" class="browser-default form-control" value="" style="padding: 6px;">
                            </div>
                            <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                                <label for="interval" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Interval</label>
                                <input type="number" id="interval" name="interval" class="browser-default form-control" value="" style="padding: 6px;">
                            </div>
                            <div class="tw-full tmb-2 lg:tmb-0 tpx-1 tpb-3">
                                <label for="message" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Message</label>
                                <textarea name="message" id="message" cols="30" rows="3" class="browser-default form-control" style="padding: 6px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect">Submit</button>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat ">create</a>
                </div>
            </div>
            
        </div>
    </div>


    

@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script>

        $('#submit').click(function () {
            $.post("https://misstisa.com/api/create-sms-message", {
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

        $(document).ready(function(){
            $('.modal').modal();

            $('.delete-btn').on('click', function() {
                var messageId = $(this).data('id');

                $.ajax({
                    url: "https://misstisa.com/api/delete-sms-message/" + messageId, 
                    type: 'DELETE', 
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The message has been deleted successfully.',
                            confirmButtonText: 'OK'
                        });
                        window.location.reload();

                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an issue deleting the message: ' + error,
                            confirmButtonText: 'Try Again'
                        });
                    }
                });
            }); // Delete Message
        });
    </script>
    
@endsection