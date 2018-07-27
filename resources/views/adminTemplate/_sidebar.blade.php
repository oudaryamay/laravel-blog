            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Posts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('posts.index', 'All Posts', array(), []) }}</li>
                      <li>{{ Html::linkRoute('posts.create', 'Create New', array(), []) }}</li>
                      <li>{{ Html::linkRoute('categories.index', 'Categories', array(), []) }}</li>
                      <li>{{ Html::linkRoute('tags.index', 'Tags', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-comments"></i> Comments <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('comment.index', 'All Comments', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i> Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('pages.index', 'All Pages', array(), []) }}</li>
                      <li>{{ Html::linkRoute('pages.create', 'Create New', array(), []) }}</li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-image"></i> Media <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li>{{ Html::linkRoute('media.index', 'All media', array(), []) }}</li>
                      <li>{{ Html::linkRoute('media.new', 'Add New', array(), []) }}</li>
                      </ul>
                  </li>
               </ul>
              </div>
            </div>