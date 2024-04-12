<aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Permintaan</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('masuk.index') }}"
                                aria-expanded="false"><i data-feather="inbox" class="feather-icon"></i><span
                                    class="hide-menu">Permintaan Masuk
                                </span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('keluar.index') }}"
                                aria-expanded="false"><i data-feather="external-link" class="feather-icon"></i><span
                                    class="hide-menu">Permintaan Keluar</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('dibatalkan.index') }}"
                                aria-expanded="false"><i data-feather="x" class="feather-icon"></i><span
                                    class="hide-menu">Permintaan Ditolak</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Data Bibit</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('bibit.index') }}"
                                aria-expanded="false"><i data-feather="align-left" class="feather-icon"></i><span
                                    class="hide-menu">Bibit</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('bibit-masuk.index') }}"
                                aria-expanded="false"><i data-feather="align-right" class="feather-icon"></i><span
                                    class="hide-menu">Bibit Masuk</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('bibit-keluar.index') }}"
                                aria-expanded="false"><i data-feather="align-center" class="feather-icon"></i><span
                                    class="hide-menu">Bibit Keluar</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Kegiatan</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="feather" class="feather-icon"></i><span
                                    class="hide-menu">Penanaman & Pembagian  </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">

                                <li class="sidebar-item"><a href="{{ route('penanaman.index') }}" class="sidebar-link"><span
                                            class="hide-menu"> Penanaman
                                        </span></a>
                                </li>

                                <li class="sidebar-item"><a href="{{ route('pembagian.index') }}" class="sidebar-link"><span
                                            class="hide-menu"> Pembagian
                                        </span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('lainnya.index') }}"
                                aria-expanded="false"><i data-feather="activity" class="feather-icon"></i><span
                                    class="hide-menu">Lainnya
                                </span></a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Manajemen User</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('biodata.index') }}"
                                aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                    class="hide-menu">Biodata Pengguna
                                </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="{{ route('user.index') }}" aria-expanded="false"><i data-feather="user"
                                    class="feather-icon"></i><span class="hide-menu">User
                                </span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
