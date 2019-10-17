<template>
  <sidebar-menu :menu="menu" :width="'240px'" />
</template>
 
<script>
export default {
  data() {
    return {
      menu: [
        {
          title: "Danh mục sản phẩm",
          icon: "icon-fa icon-fa-bookmark",
          href: "/admin/category"
        },
        {
          title: "Sản phẩm",
          icon: "fab fa-user",
          child: [
            {
              href: "/admin/product",
              title: "Danh sách"
            },
            {
              href: "/admin/product/create",
              title: "Tạo sản phẩm"
            }
          ]
        },

        {
          title: "Người dùng",
          icon: "icon-fa icon-fa-user",
          child: [
            {
              href: "/admin/user",
              title: "Danh sách người dùng "
            },
            {
              href: "/admin/unlock",
              title: "Danh sách yêu cầu mở khóa"
            }
          ]
        },
        {
          title: "Templates Email",
          icon: "icon-fa icon-fa-envelope-square",
          href: "/admin/template-email/list"
        },
        {
          title: "Cài đặt mật khẩu",
          icon: "icon-fa icon-fa-key",
          child: [
            {
              title: "Mật khẩu",
              href: "/admin/password-policy"
            },
            {
              title: "Chặn",
              icon: "icon-fa icon-fa-times-circle",
              child: [
                {
                  href: "/admin/ip",
                  title: "Ip"
                },
                {
                  href: "/admin/domain-email",
                  title: "Tên miền Email"
                }
              ]
            }
          ]
        }
      ]
    };
  }
};
</script>


