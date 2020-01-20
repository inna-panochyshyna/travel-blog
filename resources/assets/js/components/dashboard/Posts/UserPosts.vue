<template>
    <div>
    	<b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
    	<h2 class="text-center section-title my-4">My Posts</h2>
    	<router-link :to="{ name: 'createPost' }">
    		<b-button variant="dark" class="mb-3">Create new post</b-button>
    	</router-link>
    	<div v-if="!rows">
    		<p>You have not posts yet! </p>
    	</div>
    	<vue-good-table
        	:columns="columns"
        	:rows="rows"
        	:search-options="{
    		enabled: true,
    		placeholder: 'Search in Posts',
  			}"
  			:pagination-options="{
    			enabled: true,
    			mode: 'records',
    			perPage: 4
  			}"
  			@on-cell-click="editHandler"
  			styleClass="vgt-table vgt-custom striped"
    	>
    	</vue-good-table>
  	</div>
</template>

<script>
  export default {
    data() {
      	return {
        	items: [
                {
                  text: 'Dashboard',
                  to: { name: 'main' }
                },
                {
                  text: 'Posts',
                  active: true
                }
            ],
        	columns: [
        	{
        		label: 'Id',
        		field: 'id',
            	type: 'number',
            	tdClass: 'text-center',

        	},
        	{
        		label: 'Date',
        		field: 'created_at',
        		type: 'date',
    			dateInputFormat: 'yyyy-MM-dd',
    			dateOutputFormat: 'dd MMM yyyy',
    			tdClass: 'text-center',
        	},
        	{
        		label: 'Title',
        		field: 'title',
        		tdClass: 'text-center w-25',
        	},
        	{
				label: 'Category',
            	field: 'categories.name',
            	tdClass: 'text-center',
        	},
        	{
				label: '',
            	field: 'edit',
            	html: true,
            	tdClass: 'edit-column text-center',
            	sortable: false
        	}
    		],
      		rows: [],
      	}
    },
    mounted(){
        this.getData();
    },
    methods: {
        getData: function (params) {
        	axios.get('/api/users/' + this.$userId).then(resp => {
            this.rows = resp.data.user.posts;
            this.setIconFields();
            });
        },
        editHandler: function (params) {
            const className = params.event.target.className;
            let rowData = {...params.row};
            if (className.indexOf('eye') >= 0) {
              	this.$router.push({
	            	name: `showPost`,
	            	params: { id: rowData.id}
	        	});
            } else if (className.indexOf('trash') >= 0) {
              	if (window.confirm("To confirm, click 'OK'")) {
	               	this.destroyHandler(rowData);
	            }
            } 
        },
        removeDeletedRows: function (id) {
            let newRows = this.rows.filter(row => row.id !== id);
            this.rows = newRows;
        },
        destroyHandler: function (row) {
            axios.delete('/api/posts/' + row.id)
        	.then(resp => this.removeDeletedRows(row.id));                
        },
	    setIconFields: function () {
            this.rows.map(row => {
            row.created_at = this.characterLimit(row.created_at, 11);
           	row.edit = '<i class="fa fa-eye mx-1"></i><br><i class="fa fa-trash mx-1"></i>';
        	});
        },
        characterLimit: function(str, maxlength) {
            return (str.length > maxlength) ? str.slice(0, maxlength - 1) : str;
        }
    }
  }
</script>

<style scoped>
.breadcrumb-items {
    background-color: transparent!important;
}

</style>