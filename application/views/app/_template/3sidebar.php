<?php
    $user = $this->session->userdata("user_logged");
?>

<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo base_url('assets/images/user.png'); ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user->full_name; ?></div>
                <div class="email"><?php echo $user->email; ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <!--
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                        -->
                        <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= site_url('login/logout') ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="<?php echo $this->uri->segment(1) == 'dashboard'? 'active':'';?>">
                    <a href="<?= site_url('dashboard') ?>">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if($user->role==='1'):?>
                    <li class="<?php echo $this->uri->segment(1) == 'user'? 'active':'';?>">
                        <a href="<?= site_url('user') ?>">
                            <i class="material-icons">text_fields</i>
                            <span>User</span>
                        </a>
                    </li>

                    <li class="<?php echo $this->uri->segment(1) == 'dosen'? 'active':'';?>">
                        <a href="<?= site_url('dosen') ?>">
                            <i class="material-icons">text_fields</i>
                            <span>Dosen</span>
                        </a>
                    </li>

                    <li class="<?php echo $this->uri->segment(1) == 'mahasiswa'? 'active':'';?>">
                        <a href="<?= site_url('mahasiswa') ?>">
                            <i class="material-icons">text_fields</i>
                            <span>Mahasiswa</span>
                        </a>
                    </li>

                    <li class="<?php echo $this->uri->segment(1) == 'jadwal_perwalian'? 'active':'';?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Jadwal Perwalian</span>
                        </a>

                        <ul class="ml-menu">
                            <li class="<?php echo $this->uri->segment(1) == 'jadwal_perwalian'&&empty($this->uri->segment(2))? 'active':'';?>">
                                <a href="<?= site_url('jadwal_perwalian') ?>">Semua</a>
                            </li>

                            <li class="<?php echo $this->uri->segment(2) == 'menunggu'? 'active':'';?>">
                                <a href="<?= site_url('jadwal_perwalian/menunggu') ?>">Menunggu</a>
                            </li>
                            <li class="<?php echo $this->uri->segment(2) == 'dibatalkan'? 'active':'';?>">
                                <a href="<?= site_url('jadwal_perwalian/dibatalkan') ?>">Dibatalkan</a>
                            </li>
                            <li class="<?php echo $this->uri->segment(2) == 'telah_lewat'? 'active':'';?>">
                                <a href="<?= site_url('jadwal_perwalian/telah_lewat') ?>">Telah lewat</a>
                            </li>
                            <li class="<?php echo $this->uri->segment(2) == 'berlangsung'? 'active':'';?>">
                                <a href="<?= site_url('jadwal_perwalian/berlangsung') ?>">Sedang berlangsung</a>
                            </li>
                            <li class="<?php echo $this->uri->segment(2) == 'selesai'? 'active':'';?>">
                                <a href="<?= site_url('jadwal_perwalian/selesai') ?>">Selesai</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header"></li>
                <?php endif;?>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <!-- <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li> -->
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>
