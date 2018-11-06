            <?php   if (\Auth::user()->is_admin == 1) { ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('admin.index', 'Dashboard', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Posts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('ob-admin.posts.index', 'All Posts', array(), []) }}</li>
                      <li>{{ Html::linkRoute('ob-admin.posts.create', 'Create New', array(), []) }}</li>
                      <li>{{ Html::linkRoute('ob-admin.categories.index', 'Categories', array(), []) }}</li>
                      <li>{{ Html::linkRoute('ob-admin.tags.index', 'Tags', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-comments"></i> Comments <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('ob-admin.comment.index', 'All Comments', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i> Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('ob-admin.pages.index', 'All Pages', array(), []) }}</li>
                      <li>{{ Html::linkRoute('ob-admin.pages.create', 'Create New', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-image"></i> Media <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('media.index', 'All media', array(), []) }}</li>
                      <li>{{ Html::linkRoute('media.new', 'Add New', array(), []) }}</li>
                      </ul>
                  </li>
                   <li><a><i class="fa fa-shopping-cart"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('ob-admin.products.index', 'All products', array(), []) }}</li>
                      <li>{{ Html::linkRoute('ob-admin.products.create', 'Add New', array(), []) }}</li>
                      </ul>
                  </li>
                  <li><a><i class="fa fa-cog"></i> Appearance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('ob-admin.settings.option', 'Settings', array(), []) }}</li>
                    </ul>
                  </li>
               </ul>
              </div>
            </div>
          <?php } else { ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('admin.index', 'Dashboard', array(), []) }}</li>
                    </ul>
                  </li>
               </ul>
              </div>
            </div>
          <?php } ?>