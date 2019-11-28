<template>
  <div class="page-content container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Example Panel With Heading -->
        <div class="panel panel-bordered">
          <div class="panel-heading">
            <h3 class="panel-title">Quản lý bài viết</h3>
          </div>
          <div class="panel-body">
            <!-- <h4>Body Heading</h4> -->
            <table-component
              :data="getPostReviews"
              sort-by="name"
              sort-order="asc"
              ref="table"
              table-class="table"
              showFilter="true"
              :filter-placeholder="'Tìm kiếm theo tên'"
              :filterNoResults="'There are no matching rows'"
            >
              <table-column :sortable="false" :filterable="false" :label="'Ảnh'">
                <template slot-scope="row">
                  <img
                    v-if="row.feature_image !== null "
                    :src="row.feature_image"
                    style="width:50px;height:60px;"
                    alt
                  />
                  <img v-else src="/images/noimage.png" style="width:60px" alt />
                </template>
              </table-column>
              <table-column
                style="with:300px"
                show="title"
                :formatter="formatter"
                :label="'Tiêu đề'"
              />
              <!-- <table-column show="city_name" :label="'Tỉnh'" /> -->
              <table-column show="shop.name" :label="'Cửa hàng'" />
              <table-column show="user.name" :label="'Người tạo'" />
              <table-column :sortable="false" :filterable="false" :label="'Hành động'">
                <template slot-scope="row">
                  <div class="table__actions">
                    <a
                      class="btn btn-primary btn-sm text-white"
                      v-if="row.is_approve === 0"
                      @click="apporove(row.id,1, 'phê duyệt')"
                    >
                      <i class="icon-fa icon-fa-trash" />
                      Phê duyệt
                    </a>
                    <a
                      v-else
                      class="btn btn-danger btn-sm text-white"
                      @click="apporove(row.id,-1,'chặn')"
                    >
                      <i class="icon-fa icon-fa-trash" />
                      Chặn
                    </a>
                    <a class="btn btn-success btn-sm text-white" @click="deleteDomain(row.id)">
                      <i class="icon-fa icon-fa-trash" />
                      Chi tiết
                    </a>
                    <!-- <a class="btn btn-danger btn-sm text-white" @click="deleteDomain(row.id)">
                      <i class="icon-fa icon-fa-trash" />
                      Xóa
                    </a>-->
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
import PostReviewService from "../../js/services/PostReview";
export default {
  data() {
    return {
      users: {}
    };
  },
  methods: {
    async getPostReviews({ page, filter, sort }) {
      try {
        const response = await PostReviewService.getPostReviews({
          page: page,
          domain: filter,
          order_by: sort.fieldName,
          order_type: sort.order
        });
        console.log(response);
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
    apporove(id, status, title) {
      let vm = this;
      Swal.fire({
        title: `Bạn muốn ${title} bài viết này ?`,
        type: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Quay lại",
        showCloseButton: true
      }).then(result => {
        if (result.value) {
          PostReviewService.approve(id, status).then(response => {
            if (response) {
              Swal.fire({
                type: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
              });
              console.log(response);
              vm.$refs.table.refresh();
            } else {
              Swal("Xin lỗi", "Cập nhật thất bại", "error");
            }
          });
        }
      });
    },
    formatter(value, rowProperties) {
      let stringLimit = value.substring(0, 50);
      return stringLimit;
    }
  }
};
</script>