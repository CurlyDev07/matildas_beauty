<ul id="dropdown1" class="dropdown-content">
    <li>
        <a href="#!"><i class="fas fa-sign-out-alt fa-flip-horizontal"></i></a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="#!" class="ttext-center">
            <i class="fas fa-cog"></i>
        </a>
    </li>
</ul><!-- USER DROP DOWN -->


<div class="tbg-primary">
    <div class="tcontainer">
        <div class="tflex titems-center tjustify-between tpy-3">
            <div class="trelative">
                <img src="{{ asset('images/logo/main.png') }}" class="tabsolute tbg-white trounded-full" style="max-width: 46px;bottom: -22px;" alt="MB logo">
            </div>
            <a href="{{ url('/') }}" class="ttext-white tunderline">Back to site</a>
            <a href="{{ url('/') }}" class="ttext-white tunderline">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="hover:tunderline tcursor-default tfont-bold">
                        <i class="fas fa-sign-out-alt ttext-2xl"></i>
                    </button>
                </form>
            </a>

            {{-- <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                <i class="fas fa-user-secret fa-2x ttext-white"></i>
                <i class="material-icons right ttext-white" style="margin:0!important">arrow_drop_down</i>
            </a> --}}
        </div>
    </div>
</div>

<div class="row tshadow-md tm-0">
    <div class="tcontainer">
        <div class="col s12">
            <ul class="tabs tabs tflex tjustify-between">
                {{-- @if (auth()->user()->isMaster())
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'dashboard', 'active') }}" onclick="location.href = '/admin/dashboard'">
                            <i class="fas fa-desktop tmr-1 fa-lg"></i>
                            Dashboard
                        </a>
                    </li>
                @endif --}}
               
                <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'orders', 'active') }}" onclick="location.href = '/admin/orders'">
                        <i class="fas fa-shopping-cart tmr-1 fa-lg" style="color: #ff0083;"></i>
                        <span class="tfont-medium" style="color: #4f4f4f;">Orders</span>
                        
                    </a>
                </li>
                {{-- <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'shopee', 'active') }}" onclick="location.href = '/admin/shopee'">
                        <i class="fas fa-shopping-cart tmr-1 fa-lg"></i>
                        Shopee Orders
                    </a>
                </li> --}}
                <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'products', 'active') }}" onclick="location.href = '/admin/products'">
                        <i class="fas fa-box-open tmr-1 fa-lg"></i> 
                        <span class="tfont-medium" style="color: #4f4f4f;">Products</span>
                    </a>
                </li>
                <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'inventory', 'active') }}" onclick="location.href = '/admin/inventory'">
                        <i class="fas fa-warehouse tmr-1 fa-lg" style="color: #0c9919;"></i>
                        <span class="tfont-medium" style="color: #4f4f4f;">Inventory</span>
                    </a>
                </li>
                {{-- <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'inventory', 'active') }}" onclick="location.href = '/admin/inventory'">
                        <i class="fas fa-comment tmr-1 fa-lg"></i> 
                        Inventory
                    </a>
                </li> --}}
                {{-- {{ dd(auth()->user()->role) }} --}}
                @if (in_array(auth()->user()->role, ['master', 'inventory']))
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'purchase', 'active') }}" onclick="location.href = '/admin/purchase'">
                        <i class="fas fa-store-alt tmr-1 fa-lg" style="color: #ff7200"></i>
                        <span class="tfont-medium" style="color: #4f4f4f;">Purchase</span>
                        </a>
                    </li>
                @endif
                {{-- @if (auth()->user()->isMaster())
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'expenses', 'active') }}" onclick="location.href = '/admin/expenses'">
                        <i class="fas fa-users tmr-1 fa-lg"></i>
                            Expenses
                        </a> 
                    </li>
                @endif --}}
                @if (auth()->user()->isMaster())
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'suppliers', 'active') }}" onclick="location.href = '/admin/suppliers'">
                        <i class="fas fa-users tmr-1 fa-lg" style="color: #fa2666ff"></i>
                        <span class="tfont-medium" style="color: #4f4f4f;">Suppliers</span>
                        </a>
                    </li>
                @endif
                <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'rts', 'active') }}" onclick="location.href = '/admin/fb-ads'">
                        <i class="fas fa-gem tmr-1 fa-lg" style="color: #00969b"></i>
                        <span class="tfont-medium" style="color: #4f4f4f;">FB Products</span>
                        
                    </a>
                </li>
                @if (auth()->user()->isMaster())
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'users', 'active') }}" onclick="location.href = '/admin/users'">
                             <i class="fas fa-gem tmr-1 fa-lg" style="color: #4c5cc3ff"></i>
                            <span class="tfont-medium" style="color: #4f4f4f;">Users</span>
                        </a>
                    </li>
                @endif
                @if (in_array(auth()->user()->role, ['master', 'sa', 'admin']))
                    {{-- <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'stores', 'active') }}" onclick="location.href = '/admin/stores'">
                            <i class="fas fa-users tmr-1 fa-lg"></i> 
                            Stores
                        </a>
                    </li>
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'store-metrics', 'active') }}" onclick="location.href = '/admin/store-metrics'">
                            <i class="fas fa-users tmr-1 fa-lg"></i> 
                            Store Metrics
                        </a>
                    </li>

                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'powerup', 'active') }}" onclick="location.href = '/admin/powerup'">
                            <i class="fas fa-users tmr-1 fa-lg"></i> 
                            Power Up
                        </a>
                    </li> --}}
                @endif

                <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'fbads', 'active') }}" onclick="location.href = '/admin/fbads'">
                        <i class="fas fa-users tmr-1 fa-lg"></i> 
                        FB
                    </a>
                </li>


                @if (auth()->user()->isMaster())

                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'file-manager', 'active') }}" onclick="location.href = '/admin/file-manager'">
                            <i class="fas fa-images tmr-1 fa-lg" style="color: #ff0075"></i>
                            <span class="tfont-medium" style="color: #4f4f4f;">Gallery</span>
                        </a>
                    </li>
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'Lab', 'active') }}" onclick="location.href = '/admin/lab'">
                            <i class="fas fa-flask tmr-1 fa-lg" style="color: #73009dff"></i>
                            <span class="tfont-medium" style="color: #4f4f4f;">Lab</span>
                        </a>
                    </li>
                    <li class="tab col">
                        <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'sms', 'active') }}" onclick="location.href = '/admin/sms'">
                            <i class="fas fa-flask tmr-1 fa-lg" style="color: #2ca300ff"></i>
                            <span class="tfont-medium" style="color: #4f4f4f;">SMS</span>
                        </a>
                    </li>
                @endif



                {{-- <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'withdrawal', 'active') }}" onclick="location.href = '/admin/withdrawal'">
                        <i class="fas fa-users tmr-1 fa-lg"></i> 
                        Withdrawal
                    </a>
                </li> --}}
              
                {{-- <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'categories', 'active') }}" onclick="location.href = '/admin/categories'">
                        <i class="fas fa-comment tmr-1 fa-lg"></i> 
                        Categories
                    </a>
                </li> --}}
                {{-- <li class="tab col">
                    <a href="#" style="padding: 0px" class="{{ is_matched_return_class(admin_parent_nav(), 'banners', 'active') }}" onclick="location.href = '/admin/banners'">
                        <i class="fas fa-images tmr-1 fa-lg"></i> 
                        Banners
                    </a>
                </li> --}}
               
                
                
            </ul>
        </div>
    </div>
</div>