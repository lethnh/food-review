<template>
  <div class="page-content container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Example Panel With Heading -->
        <div class="panel panel-bordered">
          <div class="panel-heading">
            <h3 class="panel-title">Quản lý user</h3>
          </div>
          <div class="panel-body">
            <!-- <h4>Body Heading</h4> -->
            <table-component
              :data="getUsers"
              sort-by="name"
              sort-order="asc"
              ref="table"
              table-class="table"
              showFilter=true
              :filter-placeholder="'Tìm kiếm theo tên'"
              :filterNoResults="'There are no matching rows'"
            >
              <table-column :sortable="false" :filterable="false" :label="'Ảnh'">
                <template slot-scope="row">
                  <img :src="row.avatar" style="width:50px" alt />
                </template>
              </table-column>
              <table-column show="name" :label="'Tên'" />
              <table-column show="email" :label="'Email'" />
              <table-column show="city_name" :label="'Tỉnh'" />
              <table-column show="address" :label="'Địa chỉ'" />
              <table-column :sortable="false" :filterable="false" :label="'Hành động'">
                <template slot-scope="row">
                  <div class="table__actions">
                    <a class="btn btn-primary btn-sm text-white" @click="deleteDomain(row.id)">
                      <i class="icon-fa icon-fa-trash" />
                      Chỉnh sửa
                    </a>
                    <a class="btn btn-danger btn-sm text-white" @click="deleteDomain(row.id)">
                      <i class="icon-fa icon-fa-trash" />
                      Xóa
                    </a>
                  </div>
                </template>
              </table-column>
            </table-component>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AuthService from "../../js/services/Auth";
export default {
  data() {
    return {
      users: {}
    };
  },
  methods: {
    async getUsers({ page, filter, sort }) {
      try {
        const response = await AuthService.getUsers({
          page: page,
          domain: filter,
          order_by: sort.fieldName,
          order_type: sort.order
        });
        return {
          data: response.data,
          pagination: {
            totalPages: response.last_page,
            currentPage: page,
            count: response.total
          }
        };
      } catch (error) {
        if (error) {
          window.toastr["error"]("There was an error", "Error");
        }
      }
    }
  }
};
</script>