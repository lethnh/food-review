<template>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Example Panel With Heading -->
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Quản lý cửa hàng</h3>
                    </div>
                    <div class="panel-body">
                        <!-- <h4>Body Heading</h4> -->
                        <table-component
                            :data="getShops"
                            sort-by="name"
                            sort-order="asc"
                            ref="table"
                            table-class="table"
                            showFilter="true"
                            :filter-placeholder="'Tìm kiếm theo tên'"
                            :filterNoResults="'There are no matching rows'"
                        >
                            <table-column
                                :sortable="false"
                                :filterable="false"
                                :label="'Ảnh'"
                            >
                                <template slot-scope="row">
                                    <img
                                        v-if="row.feature_image !== null"
                                        :src="row.feature_image"
                                        style="width:50px;height:60px;"
                                        alt
                                    />
                                    <img
                                        v-else
                                        src="/images/noimage.png"
                                        style="width:60px"
                                        alt
                                    />
                                </template>
                            </table-column>
                            <!-- <table-column show="city_name" :label="'Tỉnh'" /> -->
                            <table-column show="name" :label="'Cửa hàng'" />
                            <table-column
                                show="user.name"
                                :label="'Người tạo'"
                            />
                            <table-column
                                :sortable="false"
                                :filterable="false"
                                :label="'Hành động'"
                            >
                                <template slot-scope="row">
                                    <div class="table__actions">
                                        <a
                                            class="btn btn-danger btn-sm text-white"
                                            @click="deleteShop(row.id, 'xóa')"
                                        >
                                            <i class="icon-fa icon-fa-trash" />
                                            Xóa
                                        </a>
                                                   <router-link :to="{ name: 'shopDetail', params: { shop_id: row.id }}"  class="btn btn-info btn-sm text-white">   <i class="icon-fa icon-fa-trash" />
                      Chi tiết
                  </router-link>
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
import ShopService from "../../js/services/Shop";
export default {
    data() {
        return {
            shops: {}
        };
    },
    methods: {
        async getShops({ page, filter, sort }) {
            try {
                const response = await ShopService.getLisShops({
                    page: page,
                    text: filter,
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
        deleteShop(id, title) {
            let vm = this;
            Swal.fire({
                title: `Bạn muốn ${title} cửa hàng này ?`,
                type: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Quay lại",
                showCloseButton: true
            }).then(result => {
                if (result.value) {
                    ShopService.deleteShop(id).then(response => {
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
                            Swal("Xin lỗi", "Cập nhật thất bại", "error");
                        }
                    });
                }
            });
        }
    }
};
</script>
