<template>
    <nav
        class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega"
        role="navigation"
    >
        <div class="navbar-header">
            <button
                type="button"
                class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="hamburger-bar"></span>
            </button>
            <button
                type="button"
                class="navbar-toggler collapsed"
                data-target="#site-navbar-collapse"
                data-toggle="collapse"
            >
                <i class="icon wb-more-horizontal" aria-hidden="true"></i>
            </button>
            <div
                class="navbar-brand navbar-brand-center site-gridmenu-toggle active"
                data-toggle="gridmenu"
                aria-expanded="true"
            >
                <img
                    class="navbar-brand-logo"
                    src="/images/icon/logo2.png"
                    title="Remark"
                />
            </div>
            <button
                type="button"
                class="navbar-toggler collapsed"
                data-target="#site-navbar-search"
                data-toggle="collapse"
            >
                <span class="sr-only">Toggle Search</span>
                <i class="icon wb-search" aria-hidden="true"></i>
            </button>
        </div>

        <div class="navbar-container container-fluid">
            <!-- Navbar Collapse -->
            <div
                class="collapse navbar-collapse navbar-collapse-toolbar"
                id="site-navbar-collapse"
            >
                <!-- Navbar Toolbar -->

                <!-- End Navbar Toolbar -->

                <!-- Navbar Toolbar Right -->
                <ul
                    class="nav navbar-toolbar navbar-right navbar-toolbar-right"
                >
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link"
                            data-toggle="dropdown"
                            href="javascript:void(0)"
                            data-animation="scale-up"
                            aria-expanded="false"
                            role="button"
                        >
                            <span class="flag-icon flag-icon-us"></span>
                        </a>
                        <div class="dropdown-menu" role="menu">
                            <a
                                class="dropdown-item"
                                href="javascript:void(0)"
                                role="menuitem"
                            >
                                <span class="flag-icon flag-icon-gb"></span>
                                English
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link navbar-avatar"
                            data-toggle="dropdown"
                            href="#"
                            aria-expanded="false"
                            data-animation="scale-up"
                            role="button"
                        >
                            <span
                                class="avatar avatar-online"
                                v-if="user.avatar != null"
                            >
                                <img :src="user.avatar" alt="" />
                                <i></i>
                            </span>
                            <span class="avatar avatar-online" v-else>
                                <img src="/images/5.jpg" alt="" />
                                <i></i>
                            </span>
                            <span>
                                {{ user.name }}
                            </span>
                        </a>
                        <div class="dropdown-menu" role="menu">
                            <a
                                class="dropdown-item"
                                href="javascript:void(0)"
                                role="menuitem"
                            >
                                <i class="fas fa-cog"></i> Cài đặt
                            </a>
                            <a
                                class="dropdown-item"
                                role="menuitem"
                                @click="logout()"
                            >
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
import AuthService from "../../../js/services/Auth";
export default {
    data() {
        return {
            user: {}
        };
    },
    mounted() {
        this.getInfo();
    },
    methods: {
        async getInfo() {
            AuthService.getInfo().then(response => {
                this.user = response;
            });
        },
        logout() {
            AuthService.logout().then(response => {
                this.$router.push({
                    name: "adminLogin"
                }).catch(err => {});
            });
        }
    }
};
</script>
