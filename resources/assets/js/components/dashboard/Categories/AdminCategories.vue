<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">All Categories</h2>
        <div v-if="!rows">
    	   <p>No categories! </p>
        </div>
        <router-link :to="{ name: 'adminCategoriesCreate' }">
            <b-button variant="dark" class="mb-3">Create new category</b-button>
        </router-link>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :search-options="{
    		  enabled: true,
    		  placeholder: 'Search in Categories',
  		    }"
  		    :pagination-options="{
    		  enabled: true,
    		  mode: 'records',
    		  perPage: 10
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
                  to: { name: 'mainAdmin' }
                },
                {
                  text: 'Categories',
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
                label: 'Icon',
                field: 'photo',
                tdClass: 'text-center',
                html: true,
                sortable: false,
            },
            {
        		label: 'Name',
        		field: 'name',
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
        	axios.get('/api/categories/').then(resp => {
            this.rows = resp.data.categories;
            this.setIconFields();
            });
        },
        setIconFields: function () {
            this.rows.map(row => {
            let path = '/storage/categories/'+`${row.photo}`; 
            row.photo = `<img width="40" height="40" src="${path}"/>`;
            row.edit = '<i class="fa fa-trash mx-1"></i>';
        	});
        },
        editHandler: function (params) {
            const className = params.event.target.className;
            let rowData = {...params.row};
            if (className.indexOf('trash') >= 0) {
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
            axios.delete('/api/categories/' + row.id)
            .then(resp => this.removeDeletedRows(row.id));                
        },
    }
  }
</script>

<style scoped>
.breadcrumb-items {
    background-color: transparent!important;
}
</style>