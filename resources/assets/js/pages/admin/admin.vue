<template>
    <div id="admin">
    	<customers-table></customers-table>
    </div>
</template>
<script>
import CustomersTable from './../customers/customers_table'
export default {
    name: "Admin",
    data: function () {
    	return {

    	}
    },
    components: {
    	CustomersTable
    },
    mounted: function() {

    },
    destroyed: function() {

    }
}
</script>
