            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item <?php if($pageTitle == $pageDashboard){ echo 'selected'; } ?>">
                            <a class="sidebar-link sidebar-link" href="<?php echo $urlPages ?>index.php" aria-expanded="false">
                                <i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu"><?php echo $pageDashboard ?></span>
                            </a>
                        </li>

                        <?php if($_SESSION['rank'] == 1){ ?>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap">
                            <span class="hide-menu">Administrador:</span>
                        </li>

                        <li class="sidebar-item <?php if($pageTitle == $pagePersons){ echo 'selected'; } ?>">

                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i data-feather="box" class="feather-icon"></i>
                                <span class="hide-menu"><?php echo $pagePersons ?></span>
                            </a>

                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo $urlPages ?>persons.php" class="sidebar-link">
                                        <span class="hide-menu"><?php echo $pagePepleList ?></span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="<?php echo $urlPages ?>add-person.php" class="sidebar-link">
                                        <span class="hide-menu"><?php echo $pageAddPerson ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="sidebar-item <?php if($pageTitle == $pageUsers){ echo 'selected'; } ?>">

                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i data-feather="box" class="feather-icon"></i>
                                <span class="hide-menu"><?php echo $pageUsers ?></span>
                            </a>

                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo $urlPages ?>users.php" class="sidebar-link">
                                        <span class="hide-menu"><?php echo $pageUserList ?></span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="<?php echo $urlPages ?>add-user.php" class="sidebar-link">
                                        <span class="hide-menu"><?php echo $pageAddUser ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item <?php if($pageTitle == $pageStudents){ echo 'selected'; } ?>">

                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <i data-feather="box" class="feather-icon"></i>
                                <span class="hide-menu"><?php echo $pageStudents ?></span>
                            </a>

                            <ul aria-expanded="false" class="collapse first-level base-level-line">
                                <li class="sidebar-item">
                                    <a href="<?php echo $urlPages ?>students.php" class="sidebar-link">
                                        <span class="hide-menu"><?php echo $pageStudentList ?></span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="<?php echo $urlPages ?>add-student.php" class="sidebar-link">
                                        <span class="hide-menu"><?php echo $pageAddStudent ?></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>