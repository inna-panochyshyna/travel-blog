<template>
    <div>
        <b-breadcrumb :items="items" class="breadcrumb-items"></b-breadcrumb>
        <h2 class="text-center section-title my-4">Comments</h2>
        <div v-if="!rows">
    	   <p>No comments! </p>
        </div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :search-options="{
    		  enabled: true,
    		  placeholder: 'Search in Comments',
  		    }"
  		    :pagination-options="{
    		  enabled: true,
    		  mode: 'records',
    		  perPage: 5
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
                  text: 'Comments',
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
        		label: 'Text',
        		field: 'text',
        		tdClass: 'text-center w-50',
        	},
        	{
				label: 'User',
            	field: 'user.name',
            	tdClass: 'text-center w-25',
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
        	axios.get('/api/comments/').then(resp => {
            this.rows = resp.data.comments;
            this.setIconFields();
            });
        },
        setIconFields: function () {
            this.rows.map(row => {
            row.created_at = this.characterLimit(row.created_at, 11);
            row.text = this.characterLimit(row.text, 100) + "...";
           	row.edit = '<i class="fa fa-eye mx-1"></i><br><i class="fa fa-trash mx-1"></i>';
        	});
        },
        characterLimit: function(str, maxlength) {
            return (str.length > maxlength) ? str.slice(0, maxlength - 1) : str;
        },
        editHandler: function (params) {
            const className = params.event.target.className;
            let rowData = {...params.row};
            if (className.indexOf('eye') >= 0) {
                this.$router.push({
                    name: `showCommentAdmin`,
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
            axios.delete('/api/comments/' + row.id)
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