<template>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Example Panel With Heading -->
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tạo người dùng</h3>
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
import AuthService from "../../js/services/Auth";
import Cities from "../../js/services/City";
export default {
    data() {
        return {
            citiesData: {},
            districtsData: {},
            cities: {},
            districts: {},
            defaulValue: "An Giang",
            defaulValue2: "",
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
    mounted() {
        this.getCities();
    },
    methods: {
        async createUser() {
            const isValid = await this.$refs.postReviewForm.validate();
            if (isValid) {
                AuthService.createUser(this.user).then(response => {
                    if(response){
                        this.$router.push("/admin/users").catch(err => {});
                    }
                });
            }
        },
        getCities() {
            Cities.getCities().then(response => {
                // this.citiesData = response;
                let cities = [];
                let districts = [];
                response.forEach(element => {
                    if (element["districts"]) {
                        districts.push(element["districts"]);
                    }
                    cities.push(element);
                });
                this.citiesData = cities;
                this.districtsData = districts;
            });
        },
        handleProvinceChange(value) {
            this.districts = this.districtsData[value - 1];
            this.defaulValue2 = this.districtsData[value - 1][0];
            this.user.city = value;
        },

        handleDistrictChange(value) {
            this.user.district = value;
        },
        changeImage(event){
            debugger
            this.user.avatar = event.target.files[0];
        }
    }
};
</script>
