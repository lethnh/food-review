<template>
    <sidebar-menu :menu="menu" :width="'240px'" style="padding-top:75px" />
</template>

<script>
export default {
    data() {
        return {
            menu: [
                {
                    title: "Quản lý người dùng",
                    icon: "fas fa-users",
                    child: [
                        {
                            href: "/admin/users",
                            title: "Danh sách người dùng"
                        },
                        {
                            href: "/admin/user/create",
                            title: "Tạo người dùng"
                        }
                    ]
                },
                {
                    title: "Quản lý Bài viết",
                    icon: "fas fa-mail-bulk",
                    child: [
                        {
                            href: "/admin/post-review",
                            title: "Danh sách bài viết"
                        },
                        {
                            href: "/admin/product/create",
                            title: "Tạo sản phẩm"
                        }
                    ]
                },
                {
                    title: "Quảny lý cửa hàng",
                    icon: "fas fa-store-alt",
                    child: [
                        {
                            href: "/admin/shops",
                            title: "Danh sách cửa hàng"
                        },
                        {
                            href: "/admin/shop/create",
                            title: "Tạo cửa hàng"
                        }
                    ]
                }
            ]
        };
    }
};
</script>
