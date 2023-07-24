@extends('admin.suppliers.layouts')


@section('page')



    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Suppliers</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
                <li class="tmr-4 tpt-1">
                    @if (request()->sort == 'asc')
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by newest">
                            <i class="material-icons grey-text tmr-3">sort_by_alpha</i>
                        </a>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by oldest">
                            <i class="material-icons grey-text">sort_by_alpha</i>
                        </a>
                    @endif
                </li><!-- SORT -->
                <li>
                    <a href="/admin/shopee/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Contact</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Address</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Access</th>
                    </tr>
                </tbody>

                @foreach ($users as $user)
                    <tr class="ttext-center">
                        <td class="ttext-sm ttext-center">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="ttext-sm ttext-center">{{ $user->phone_number }}  <br>  {{ $user->email }} </td>
                        <td class="ttext-sm ttext-center">{{ $user->address }}, {{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}</td>
                        <td class="ttext-sm ttext-center">
                            <select data-id="{{ $user->id }}" class="role form-control browser-default tmx-auto" style="width: 86px;">
                                <option value="user" {{ $user->role == 'user'?'selected':'' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin'?'selected':'' }}>Admin</option>
                                <option value="sa" {{ $user->role == 'sa'?'selected':'' }}>Sa</option>
                                <option value="inventory" {{ $user->role == 'inventory'?'selected':'' }}>Inventory</option>
                                <option value="master" {{ $user->role == 'master'?'selected':'' }}>Master</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                

            </table>

        </div><!-- TABLE -->

    </div>
@endsection


@section('js')
<script src="{{ asset('js/plugins/sweatalert.js') }}"></script>

<script>
    $(document).ready(function(){

        // CHANGE STATUS
        $('.role').change(function(){
            let id = $(this).data('id');
            let role = $(this).val();

            console.log(id)
            console.log(role)

            $.ajax({
                url: '/admin/users/change-role',
                type: 'POST',
                data: {
                    id: id,
                    role: role,
                },
                success: ()=>{
                    Swal.fire({
                        icon: 'success',
                        title: 'Awesome',
                        text: 'Role Modified',
                    });
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection