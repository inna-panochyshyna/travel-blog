<ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
    <li class="nav-item ">
        <a class="nav-link active bg-dark text-white mr-2 px-1" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User Dashboard</a>
    </li>
    @if (Auth::user()->role == "admin")
    <li class="nav-item">
        <a class="nav-link bg-secondary text-white ml-2 px-1" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Admin Dashboard</a>
    </li>
    @endif
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item list-group-item-action">
                <router-link :to="{ name: 'main' }" class="text-dark">
                    <img src="/storage/images/activity.png" class="dashboard-icon mr-2" alt="Icon for activity">
                    My Activity
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action" >
                <router-link :to="{ name: 'userPosts' }" class="text-dark">
                    <img src="/storage/images/posts.png" class="dashboard-icon mr-2" alt="Icon for posts">
                    My Posts
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action">
                <router-link :to="{ name: 'userComments' }" class="text-dark">
                    <img src="/storage/images/comments.png" class="dashboard-icon mr-2" alt="Icon for comments">
                    My Comments
                </router-link>
            </li>
        </ul>
    </div>
    @if (Auth::user()->role == "admin")
    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <ul class="list-group list-group-flush mt-3">
            <li class="list-group-item list-group-item-action">
                <router-link :to="{ name: 'mainAdmin' }" class="text-dark">
                    <img src="/storage/images/activity.png" class="dashboard-icon mr-2" alt="Icon for activity">
                    Travel Blog Activity
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action" >
                <router-link :to="{ name: 'adminUsers' }" class="text-dark">
                    <img src="/storage/images/users.png" class="dashboard-icon mr-2" alt="Icon for posts">
                    All Users
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action" >
                <router-link :to="{ name: 'adminCategories' }" class="text-dark">
                    <img src="/storage/images/categories.png" class="dashboard-icon mr-2" alt="Icon for posts">
                    All Categories
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action" >
                <router-link :to="{ name: 'adminPosts' }" class="text-dark">
                    <img src="/storage/images/posts.png" class="dashboard-icon mr-2" alt="Icon for posts">
                    All Posts
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action">
                <router-link :to="{ name: 'adminComments' }" class="text-dark">
                    <img src="/storage/images/comments.png" class="dashboard-icon mr-2" alt="Icon for comments">
                    All Comments
                </router-link>
            </li>
            <li class="list-group-item list-group-item-action">
                <router-link :to="{ name: 'adminMessages' }" class="text-dark">
                    <img src="/storage/images/messages.png" class="dashboard-icon mr-2" alt="Icon for comments">
                    All Messages
                </router-link>
            </li>
        </ul>
    </div>
    @endif
</div>


