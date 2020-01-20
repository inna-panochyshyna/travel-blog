<template>
    <div class="section pb-4" id="posts">
        <blockquote class="blockquote m-0">
            <p>"The Real Voyage Of Discovery Consists Not In Seeking New Landscapes, But In Having New Eyes"</p>
            <footer class="blockquote-footer">Marcel Proust</footer>
        </blockquote>
		<b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">Posts</h2>
        <div class="d-flex justify-content-end mb-3 mr-1">
            <b-form-input v-model="searchHandler" @keyup="" class="search-input" type="text" placeholder="Search by title..."></b-form-input>
        </div>
        <div class="row mr-0">
            <div class="col-12 col-md-3 d-flex-column submenu pr-1">
		      	<b-form-select v-model="sortHandler" class="mb-3 mt-1" >
  					<option value="">Sort by title...</option>
  					<option value="titleAsc" >A &#8594; Z</option>
        			<option value="titleDesc">Z &#8594; A</option>
  				</b-form-select>
  				<div role="tablist">
    			    <b-card no-body class="mb-1">
      					<b-card-header header-tag="header" class="p-1" role="tab">
        					<b-button block href="#" v-b-toggle.accordion-3 variant="dark" class="submenu-title">Categories</b-button>
      					</b-card-header>
      					<b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
        					<b-card-body>
								<b-card-text v-for="category in categories" v-bind:data="category" v-bind:key="category.id">
								    <p class="filter-name" @click="filterOption=`category`, filterParam=`${category.name}`, filtredList()">
									   <img :src="`${imgCategory_path}/${category.photo}`" :alt="category.name" class="category-img mr-2">
									   {{ category.name }}	
							        </p>
								</b-card-text>
        					</b-card-body>
      					</b-collapse>
    				</b-card>
		    		<b-card no-body class="mb-1">
      					<b-card-header header-tag="header" class="p-1" role="tab">
        					<b-button block href="#" v-b-toggle.accordion-4 variant="dark" class="submenu-title">Authors</b-button>
      					</b-card-header>
      					<b-collapse id="accordion-4" accordion="my-accordion" role="tabpanel">
        					<b-card-body>
          						<b-card-text v-for="user in users" v-bind:data="user" v-bind:key="user.id">
          							<p class="filter-name" @click="filterOption=`user`, filterParam=`${user.name}`, filtredList()">
										<img :src="`${imgUser_path}/${user.avatar}`" :alt="user.name" class="user-img rounded-circle mr-2">
								   		{{ user.name }}
									</p>
          						</b-card-text>
        					</b-card-body>
      					</b-collapse>
    				</b-card>
                    <b-card no-body class="mb-1">
                        <b-card-header class="p-1">
                            <b-button block variant="dark" class="submenu-title" @click="dropFilters"> &times; Drop all filters </b-button>
                        </b-card-header>
                    </b-card>
    			</div>
            </div>
            <div class="col-12 col-md-9">
               	<div class="row justify-content-center">
               		<b-card v-for="post in postsDisplay" v-bind:data="post" v-bind:key="post.id"
     				:title="`${post.title}`" 
                	:img-src="`${imgPost_path}/${post.photo}`" 
                	img-alt="Image"
    				img-top
    				class="col-12 col-md-5 mx-4 mb-4 p-0">
    					<template v-slot:header>
        					<h6 class="mb-0 text-right">{{ post.categories.name }} / {{ post.user.name }}</h6>
      					</template>
    					<b-card-text class="text-justify" v-html="characterLimit(post.text, 200)"></b-card-text>
    					<router-link :to="{ name: 'post', params: { id: post.id} }">
    						<a href="" class="d-flex justify-content-end pr-3">Read more&nbsp;&raquo;</a>
    					</router-link>
  						<template v-slot:footer>
        					<small class="text-muted d-flex justify-content-between">
        						<div v-html="formatDate(post.created_at)"></div>
        						<div v-html="`${post.number_comments} comments`"></div>
        					</small>
      					</template>
  					</b-card>
				</div>
				<div class="mt-3 text-center">
      				<b-button class="mx-1" variant="light" v-if="page != 1" @click="pageHandler(--page)"> &#8592; </b-button>
      				<b-button class="mx-1" variant="dark" v-for="pageNumber in pages.slice(page-1, page+perPage)" v-bind:data="pageNumber" v-bind:key="pageNumber" @click="pageHandler(pageNumber)"> {{pageNumber}} </b-button>
      				<b-button class="mx-1" variant="light" v-if="page < pages.length" @click="pageHandler(++page)"> &#8594; </b-button>
    			</div>
            </div>
        </div>
    </div>
</template>

<script>
   	export default {
        data() {
            return {
                items: [
                    {
                        text: 'Home',
                        to: { name: 'home' }
                    },
                    {
                        text: 'Posts',
                        active: true
                    }
                ],
                posts: [],
                postsDisplay: [],
                postsChanged: [],
                categories: [],
                users: [],
                imgPost_path: "/storage/posts",
                imgCategory_path: "/storage/categories",
                imgUser_path: "/storage/avatars",
        		page: 1,
        		perPage: 10,
        		pages: [],
        		sortParam: "",
        		filterParam: "",
        		filterOption: "",
        		searchParam: ""
            }
        },
        mounted() {
            this.getPosts();
            this.getCategories();
            this.getUsers();
        },
        computed: {
            sortHandler: {
                get() {
                    return this.sortParam;
                },
                set(value) {
                    this.sortParam = value;
                    this.sortedList();
                }
            },
            searchHandler: {
                get() {
                    return this.searchParam;
                },
                set(value) {
                    this.searchParam = value;
                    this.searchedList();
                }
            }
        },
        methods: {
			getPosts: function(query) {
                axios.get('/api/posts').then(response => {
                this.posts = response.data.posts;
                this.setPages(this.posts);
                this.paginate(this.posts);
                this.getNumberComments(this.posts);
				}).catch( error => {
        		console.log(error)
      			});
      		},
			getCategories: function(query) {
                axios.get('/api/categories').then(response => {
                this.categories = response.data.categories;
                }).catch( error => {
        		console.log(error)
      			});
			},
			getUsers: function(query) {
                axios.get('/api/users').then(response => {
                this.users = response.data.users;
				}).catch( error => {
        		console.log(error)
      			});
			},
			characterLimit: function(str, maxlength) {
                return (str.length > maxlength) ? str.slice(0, maxlength - 1) + '…' : str;
            },
            formatDate: function(date) {
            	let data = new Date(date);
            	let dayOfMonth = data.getDate();
				let month = data.getMonth() + 1;
  				let year = data.getFullYear();
  				month = month < 10 ? '0' + month : month;
  				dayOfMonth = dayOfMonth < 10 ? '0' + dayOfMonth : dayOfMonth;
  				return `${dayOfMonth}.${month}.${year}`;
            },
            getNumberComments: function(data) {
            	for (let i = 0; i < data.length; i ++) {
            		data[i].number_comments = data[i].comments.length;
            	};
            },
            setPages(posts) {
            	let numberOfPages = Math.ceil(posts.length / this.perPage);
            	for (let index = 1; index <= numberOfPages; index++) {
                	this.pages.push(index);
            	};
        	},
            pageHandler(pageNumber) {
                this.page = pageNumber;
                if(!this.postsChanged.length) {
                   this.paginate(this.posts);
                } else {
                    this.paginate(this.postsChanged);
                };
            },
        	paginate(posts) {
                let page = this.page;
            	let perPage = this.perPage;
            	let from = (page * perPage) - perPage;
            	let to = (page * perPage);
            	this.postsDisplay = posts.slice(from, to);
        	},
            sortByTitleAsc: function (d1, d2) {
        		return (d1.title.toLowerCase() > d2.title.toLowerCase()) ? 1 : -1;
        	},
        	sortByTitleDesc: function (d1, d2) {
        		return (d1.title.toLowerCase() < d2.title.toLowerCase()) ? 1 : -1;
        	},
            sortedList() {
                this.postsChanged = [];
                switch(this.sortParam) {
                    case 'titleAsc': 
                        this.postsChanged = this.posts.slice();
                        this.postsChanged.sort(this.sortByTitleAsc);
                        this.paginate(this.postsChanged); 
                    break;
                    case 'titleDesc': 
                        this.postsChanged = this.posts.slice();
                        this.postsChanged.sort(this.sortByTitleDesc);
                        this.paginate(this.postsChanged); 
                    break; 
                };
            },
            filtredList: function() {
                let filter = this.filterParam;
                this.postsChanged = [];
                switch(this.filterOption) {
                    case 'category': 
                        this.pages = [];
                        this.postsChanged = this.posts.filter(function (elem) {
                            return elem.categories.name.indexOf(filter) > -1;
                        });
                        this.setPages(this.postsChanged);
                        this.paginate(this.postsChanged); 
                    break;
                    case 'user': 
                        this.pages = [];
                        this.postsChanged = this.posts.filter(function (elem) {
                            return elem.user.name.indexOf(filter) > -1;
                        });
                        this.setPages(this.postsChanged);
                        this.paginate(this.postsChanged); 
                    break;
                };
            },
            searchedList: function() {
                let search = this.searchParam;
                this.postsChanged = [];
                this.pages = [];
                this.postsChanged = this.posts.filter(function (elem) {
                    return elem.title.toLowerCase().includes(search.toLowerCase())
                });
                this.setPages(this.postsChanged);
                this.paginate(this.postsChanged);
            },
            dropFilters: function() {
                this.postsChanged = [];
                this.pages = [];
                this.searchParam = "";
                this.setPages(this.posts);
                this.paginate(this.posts); 
            }
        }
    }

</script>

<style scoped>
	.card-img-top {
		height: 30vh;
		object-fit: cover;
	}
	.card-title {
		text-align: center;
	}
	.category-img {
		height: 35px;
	}
	.user-img {
		height: 35px;
		width: 35px;
	    object-fit: cover;
	}
	.search-input {
		width: 100vw;
	}
    .filter-name:hover {
        cursor: pointer;
    }
    @media (min-width: 768px) {
        .search-input {
            width: 25vw;
        }
    }
</style>