<template>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Example Panel With Heading -->
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Chi tiết người dùng</h3>
                    </div>
                    <div class="panel-body">
                        <ValidationProvider>
                            <ValidationObserver
                                class="panel p-3 mb-0"
                                v-slot="{ passes }"
                                ref="postReviewForm"
                                tag="form"
                                @submit.prevent="createUser()"
                            >
                                <div class="form-row">
                                    <ValidationProvider
                                        name="name"
                                        rules="required"
                                        class=" col-md-6"
                                    >
                                        <div slot-scope="{ errors }">
                                            <div class="form-group ">
                                                <label for="inputPassword4"
                                                    >Tên</label
                                                >
                                                <span
                                                    :class="{
                                                        'is-danger': errors[0]
                                                    }"
                                                    >{{ errors[0] }}</span
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid': errors[0]
                                                    }"
                                                    v-model="user.name"
                                                />
                                            </div>
                                        </div>
                                    </ValidationProvider>
                                    <ValidationProvider
                                        name="email"
                                        rules="required|email"
                                        class=" col-md-6"
                                    >
                                        <div slot-scope="{ errors }">
                                            <div class="form-group">
                                                <label for="inputEmail4"
                                                    >Email</label
                                                >
                                                <span
                                                    :class="{
                                                        'is-danger': errors[0]
                                                    }"
                                                    >{{ errors[0] }}</span
                                                >
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid': errors[0]
                                                    }"
                                                    v-model="user.email"
                                                />
                                            </div>
                                        </div>
                                    </ValidationProvider>
                                    <ValidationProvider
                                        name="password"
                                        rules="required"
                                        class=" col-md-6"
                                    >
                                        <div slot-scope="{ errors }">
                                            <div class="form-group ">
                                                <label for="inputPassword4"
                                                    >Mật khẩu</label
                                                >
                                                <span
                                                    :class="{
                                                        'is-danger': errors[0]
                                                    }"
                                                    >{{ errors[0] }}</span
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid': errors[0]
                                                    }"
                                                    v-model="user.password"
                                                />
                                            </div>
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputCity">City</label>
                                        <a-select
                                            style="width: 200px"
                                            class="mr-2 d-block"
                                            :defaultValue="defaulValue"
                                            @change="handleProvinceChange"
                                        >
                                            <a-select-option
                                                v-for="province in citiesData"
                                                :key="province.id"
                                                >{{
                                                    province.name
                                                }}</a-select-option
                                            >
                                        </a-select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputCity">Huyện</label>
                                        <a-select
                                            style="width: 200px"
                                                       class="mr-2 d-block"
                                            :defaultValue="defaulValue2"
                                            @change="handleDistrictChange"
                                        >
                                            <a-select-option
                                                v-for="district in districts"
                                                :key="district.id"
                                                >{{
                                                    district.name
                                                }}</a-select-option
                                            >
                                        </a-select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputZip">Age</label>
                                        <input
                                            type="text"
                                            v-model="user.age"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Ảnh</label>
                                    <input
                                        type="file"
                                        name="avatar"
                                        @click="changeImage(event)"
                                        class="form-control"
                                    />
                                </div>
                                <button class="btn btn-primary btn-width">
                                    Tạo
                                </button>
                            </ValidationObserver>
                        </ValidationProvider>
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
     user: {
                email: "",
                password: "",
                age: "",
                city: "",
                district: "",
                name: "",
                avatar: null,
            }
    };
  },
  methods: {
    async getUser({ page, filter, sort }) {
      try {
        const response = await AuthService.getInfo({
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
  }
};
</script>