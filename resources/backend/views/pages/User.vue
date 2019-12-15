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
                  <img :src="row.avatar" v-if="row.avatar != null" style="width:50px" alt />
                  <img src="/images/5.jpg" v-else style="width:50px" alt />
                </template>
              </table-column>
              <table-column show="name" :label="'Tên'" />
              <table-column show="email" :label="'Email'" />
              <table-column show="city_name" :label="'Tỉnh'" />
              <table-column show="address" :label="'Địa chỉ'" />
              <table-column :sortable="false" :filterable="false" :label="'Hành động'">
                <template slot-scope="row">
                  <div class="table__actions">
                <!-- <router-link  :to="{ name: 'userDetail', params: { user_id: row.id }}" class="btn btn-info  btn-sm">Xem chi tiết</router-link> -->
                    <a class="btn btn-danger btn-sm text-white" v-if="row.status == 1" @click="blockUser(row.id)">
                      <i class="icon-fa icon-fa-trash" />
                      Khóa 
                    </a>
                         <a class="btn btn-success btn-sm text-white" v-else @click="unBlockUser(row.id)">
                      <i class="icon-fa icon-fa-trash" />
                      Mở khóa 
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
import Swal from "sweetalert2";
import "sweetalert2/src/sweetalert2.scss";
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
          text: filter,
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
    },
    blockUser(id){
         let vm = this;
      Swal.fire({
        title: `Bạn muốn block user này ?`,
        type: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Quay lại",
        showCloseButton: true
      }).then(result => {
        if (result.value) {
          AuthService.blockUser(id).then(response => {
            if (response) {
              Swal.fire({
                type: "success",
                title: "Thành công",
                showConfirmButton: false,
                timer: 1500
              });
              console.log(response);
              vm.$refs.table.refresh();
            } else {
              Swal("Xin lỗi", "Thất bại", "error");
            }
          });
        }
      });
    },
      unBlockUser(id){
         let vm = this;
      Swal.fire({
        title: `Bạn muốn mở khóa user này ?`,
        type: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Quay lại",
        showCloseButton: true
      }).then(result => {
        if (result.value) {
          AuthService.unBlockUser(id).then(response => {
            if (response) {
              Swal.fire({
                type: "success",
                title: "Thành công",
                showConfirmButton: false,
                timer: 1500
              });
              console.log(response);
              vm.$refs.table.refresh();
            } else {
              Swal("Xin lỗi", "Thất bại", "error");
            }
          });
        }
      });
    }
  }
};
</script>