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
                                                    type="password"
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
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">City</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="inputCity"
                                        />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">State</label>
                                        <select
                                            id="inputState"
                                            class="form-control"
                                        >
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">Age</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Ảnh</label>
                                    <input
                                        type="file"
                                        name="avatar"
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
            }
        };
    },
    methods: {
        async createUser() {
            const isValid = await this.$refs.postReviewForm.validate();
            if (isValid) {
                AuthService.createUser(this.user).then(response => {});
            }
        }
    }
};
</script>
