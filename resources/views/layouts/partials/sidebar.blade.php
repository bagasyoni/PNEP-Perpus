<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
            @if(Auth::guard('administrator')->check())
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('dashboard')}}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Master Data</span></li>

                <!-- <li class="sidebar-item"> <a class="sidebar-link" href="{{url('mastertps')}}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">Data TPS
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('masterusers')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Data Users</span></a>
                </li> -->
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('masterbuku')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Data Buku</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('mastergenre')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Data Genre</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('mastermember')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Data Member</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Transaksi</span></li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('tpinjam')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Peminjaman Buku</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('tkembali')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Pengembalian Buku</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Report</span></li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('tpinjam')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Laporan Peminjaman</span></a>
                </li>
            @elseif(Auth::guard('pengawas')->check())
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('pengawas')}}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Upload Data</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{url('profile')}}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">My Profil</span></a></li>
            @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>