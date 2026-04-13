<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5> <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('admin.dashboard')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Dashboard
                                </a> 
                            </li>

                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('category.list')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Medicine Categories
                                </a> 
                            </li>

                             <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('products.list')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Medicines
                                </a> 
                            </li>

                             <!-- <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('customer.index')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Customers
                                </a> 
                            </li> -->

                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('demands.index')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Production Orders
                                </a> 
                            </li>

                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('materials.index')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Packaging Materials
                                </a> 
                            </li>

                            
                            
                              <!-- <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('stocks.index')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Stock Management
                                </a> 
                            </li> -->
                            

                               

                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('reports.production')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Reports
                                </a> 
                            </li>
                              <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('admin-users.index')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Admin Users
                                </a> 
                            </li>
                             <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{route('factory-settings.index')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Factory settings
                                </a> 
                            </li>
                            
                        </ul>
                       
                        
                        <hr class="my-3">
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <div class="text-muted mb-2">
                                    <small>Logged in as: <strong>{{ Auth::user()?->name ?? 'Guest' }}</strong></small><br>
                                    <small class="text-secondary">{{ Auth::user()?->email ?? '' }}</small>
                                </div>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('auth.logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="nav-link d-flex align-items-center gap-2 border-0 bg-transparent" style="cursor: pointer;">
                                        <svg class="bi" aria-hidden="true">
                                            <use xlink:href="#door-closed"></use>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>