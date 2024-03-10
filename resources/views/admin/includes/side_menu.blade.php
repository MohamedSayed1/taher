<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ areActiveRoutes(['dashboard']) }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-fw fa-th"><span class="path1"></span><span class="path2"></span></i>
                    <span>{{ trans('messages.Dashboard') }}</span>
                </a>
            </li>
            @can('moderator_list')
                <li class="{{ areActiveRoutes(['user.index', 'user.create', 'user.edit', 'user.show']) }}">
                    <a href="{{ route('user.index') }}">
                        <i class="fa fa-users"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span>{{ trans('messages.Moderators') }}</span>
                    </a>
                </li>
            @endcan
            @can('client_list')
                <li class="{{ areActiveRoutes(['client.index', 'client.create', 'client.edit', 'client.show']) }}">
                    <a href="{{ route('client.index') }}">
                        <i class="fa fa-users"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span>{{ trans('messages.Clients') }}</span>
                    </a>
                </li>
            @endcan
            <li
                class="{{ areActiveRoutes(['subscription.index', 'subscription.create', 'subscription.edit', 'subscription.show']) }}">
                <a href="{{ route('subscription.index') }}">
                    <i class="fa fa-users"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span></i>
                    <span>{{ trans('messages.Subscriptions') }}</span>
                </a>
            </li>
            @can('opinion_list')
                <li class="{{ areActiveRoutes(['opinion.index', 'opinion.create', 'opinion.edit', 'opinion.show']) }}">
                    <a href="{{ route('opinion.index') }}">
                        <i class="fa fa-users"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span>{{ trans('messages.Opinions') }}</span>
                    </a>
                </li>
            @endcan
            @can('role_list')
                <li class="{{ areActiveRoutes(['role.index', 'role.create', 'role.edit', 'role.show']) }}">
                    <a href="{{ route('role.index') }}">
                        <i class="mdi mdi-do-not-disturb-off"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span>{{ trans('messages.Roles') }}</span>
                    </a>
                </li>
            @endcan
            @can('page_list')
                <li class="{{ areActiveRoutes(['page.index', 'page.create', 'page.edit', 'page.show']) }}">
                    <a href="{{ route('page.index') }}">
                        <i class="si-bag si"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span>{{ trans('messages.Static Pages') }}</span>
                    </a>
                </li>
            @endcan
            @can('faq_list')
                <li class="{{ areActiveRoutes(['faq.index', 'faq.create', 'faq.edit', 'faq.show']) }}">
                    <a href="{{ route('faq.index') }}">
                        <i class="si-bag si"><span class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i>
                        <span>{{ trans('messages.Faqs') }}</span>
                    </a>
                </li>
            @endcan
            <li
                class="{{ areActiveRoutes(['youtubVideos.index', 'youtubVideos.create', 'youtubVideos.edit', 'youtubVideos.show']) }}">
                <a href="{{ route('youtubVideos.index') }}">
                    <i class="si-bag si"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span></i>
                    <span>{{ trans('messages.Youtube Videos') }}</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="si-bag si"></i>
                    <span class="side-nav-text">{{ trans('messages.Blog') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('blog_category_list')
                        <li
                            class="{{ areActiveRoutes(['blogCategory.index', 'blogCategory.create', 'blogCategory.edit', 'blogCategory.show']) }}">
                            <a href="{{ route('blogCategory.index') }}"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Category') }}</span></a>
                        </li>
                    @endcan
                    @can('blog_list')
                        <li class="{{ areActiveRoutes(['blog.index', 'blog.create', 'blog.edit', 'blog.show']) }}">
                            <a href="{{ route('blog.index') }}"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Blog') }}</span></a>
                        </li>
                    @endcan
                    <li
                        class="{{ areActiveRoutes(['blogComment.index', 'blogComment.create', 'blogComment.edit', 'blogComment.show']) }}">
                        <a href="{{ route('blogComment.index') }}"><i class="icon-Commit"><span
                                    class="path1"></span><span class="path2"></span></i><span
                                class="side-nav-text">{{ trans('messages.Comments') }}</span></a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="si-bag si"></i>
                    <span class="side-nav-text">{{ trans('messages.Exams') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li
                        class="{{ areActiveRoutes(['theoryPackage.index', 'theoryPackage.create', 'theoryPackage.edit', 'theoryPackage.show']) }}">
                        <a href="{{ route('theoryPackage.index') }}"><i class="icon-Commit"><span
                                    class="path1"></span><span class="path2"></span></i><span
                                class="side-nav-text">{{ trans('messages.Theory Package') }}</span></a>
                    </li>
                    @can('package_list')
                        <li
                            class="{{ areActiveRoutes(['package.index', 'package.create', 'package.edit', 'package.show']) }}">
                            <a href="{{ route('package.index') }}"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Packages') }}</span></a>
                        </li>
                    @endcan
                    @can('exam_list')
                        <li class="{{ areActiveRoutes(['exam.index', 'exam.create', 'exam.edit', 'exam.show']) }}">
                            <a href="{{ route('exam.index') }}"><i class="icon-Commit"><span class="path1"></span><span
                                        class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Exams') }}</span></a>
                        </li>
                    @endcan
                    @can('exam_category_list')
                        <li
                            class="{{ areActiveRoutes(['examCategory.index', 'examCategory.create', 'examCategory.edit', 'examCategory.show']) }}">
                            <a href="{{ route('examCategory.index') }}"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Exam Categories') }}</span></a>
                        </li>
                    @endcan
                    @can('question_list')
                        <li
                            class="{{ areActiveRoutes(['question.index', 'question.create', 'question.edit', 'question.show']) }}">
                            <a href="{{ route('question.index') }}"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Questions') }}</span></a>
                        </li>
                    @endcan
                    @can('answer_list')
                        <li
                            class="{{ areActiveRoutes(['answer.index', 'answer.create', 'answer.edit', 'answer.show']) }}">
                            <a href="{{ route('answer.index') }}"><i class="icon-Commit"><span
                                        class="path1"></span><span class="path2"></span></i><span
                                    class="side-nav-text">{{ trans('messages.Answers') }}</span></a>
                        </li>
                    @endcan
                    <li
                        class="{{ areActiveRoutes(['examOpinion.index', 'examOpinion.create', 'examOpinion.edit', 'examOpinion.show']) }}">
                        <a href="{{ route('examOpinion.index') }}"><i class="icon-Commit"><span
                                    class="path1"></span><span class="path2"></span></i><span
                                class="side-nav-text">{{ trans('messages.Problems') }}</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <div class="sidebar-footer">

    </div>
</aside>
