<template>
  <sidebar-menu :menu="menu" :width="'240px'" style="padding-top:75px" />
</template>
 
<script>
export default {
  data() {
    return {
      menu: [
        {
          title: "Người dùng",
          icon: "fas fa-users",
          href: "/admin/user"
        },
        {
          title: "Bài viết",
          icon: "fas fa-mail-bulk",
          child: [
            {
              href: "/admin/post-review",
              title: "Danh sách"
            },
            {
              href: "/admin/product/create",
              title: "Tạo sản phẩm"
            }
          ]
        },
        {
          title: "Cửa hàng",
          icon: "fas fa-store-alt",
          href: "/admin/template-email/list"
        }
      ]
    };
  }
};
</script>


