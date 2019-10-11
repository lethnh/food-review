<template>
  <div>
    <section>
      <div class="section-title">
        <h3>Cửa hàng review nhiều nhất</h3>
      </div>
      <div class="section-content m-t-20">
        <div class="list-shops">
          <div class="row">
            <div class="col-3">
              <b-card
                img-src="https://picsum.photos/600/600/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                class="mb-2 shadow"
              >
             <a href="">      
              <h4 class="card-title">
              Card Title 
              </h4> 
              </a>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span>5</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-comment-dots"></i>
                    <span>0</span>
                  </div>
                </div>
                <div class="shop-money">
                  <i class="fas fa-money-bill"></i> 100.000 đ
                </div>
                <div class="shop-address">
                  <small class="text-muted">
                    <i class="fas fa-map-marker-alt"></i>
                    Hà Nội
                  </small>
                </div>
                <b-card-text></b-card-text>
                <template v-slot:footer>
                  <a href class="shop-tag rounded">cửa hàng</a>
                </template>
              </b-card>
            </div>
            <div class="col-3">
                 <b-card
                img-src="https://picsum.photos/600/600/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                class="mb-2 shadow"
              >
             <a href="">      
              <h4 class="card-title">
              Card Title 
              </h4> 
              </a>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span>5</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-comment-dots"></i>
                    <span>0</span>
                  </div>
                </div>
                <div class="shop-money">
                  <i class="fas fa-money-bill"></i> 100.000 đ
                </div>
                <div class="shop-address">
                  <small class="text-muted">
                    <i class="fas fa-map-marker-alt"></i>
                    Hà Nội
                  </small>
                </div>
                <b-card-text></b-card-text>
                <template v-slot:footer>
                  <a href class="shop-tag rounded">cửa hàng</a>
                </template>
              </b-card>
            </div>
            <div class="col-3">
              <b-card
                title="Card Title"
                img-src="https://picsum.photos/600/300/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                class="mb-2"
              >
                <b-card-text>Some quick example text to build on the card title and make up the bulk of the card's content.</b-card-text>
              </b-card>
            </div>
            <div class="col-3">
              <b-card
                title="Card Title"
                img-src="https://picsum.photos/600/300/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                class="mb-2"
              >
                <b-card-text>Some quick example text to build on the card title and make up the bulk of the card's content.</b-card-text>
              </b-card>
            </div>
          </div>
        </div>
      </div>
    </section>
    <hr class="my-5" />
    <section>
      <div class="section-title">
        <h3>Cửa hàng review gần đây</h3>
      </div>
      <div class="section-content m-t-20">
        <div>
          <b-card-group deck>
            <b-card
              title="Title"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>
                This is a wider card with supporting text below as a natural lead-in to additional content.
                This content is a little bit longer.
              </b-card-text>
              <template v-slot:footer>
                <small class="text-muted">
                  <i class="fas fa-map-marker-alt"></i>
                  Hà Nội
                </small>
              </template>
            </b-card>
            <b-card
              title="Title"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>
                This is a wider card with supporting text below as a natural lead-in to additional content.
                This content is a little bit longer.
              </b-card-text>
              <template v-slot:footer>
                <small class="text-muted">
                  <i class="fas fa-map-marker-alt"></i>
                  Hà Nội
                </small>
              </template>
            </b-card>
            <b-card
              title="Title"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>
                This is a wider card with supporting text below as a natural lead-in to additional content.
                This content is a little bit longer.
              </b-card-text>
              <template v-slot:footer>
                <small class="text-muted">
                  <i class="fas fa-map-marker-alt"></i>
                  Hà Nội
                </small>
              </template>
            </b-card>

            <b-card
              title="Title"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>This card has supporting text below as a natural lead-in to additional content.</b-card-text>
              <template v-slot:footer>
                <small class="text-muted">
                  <i class="fas fa-map-marker-alt"></i>
                  Hà Nội
                </small>
              </template>
            </b-card>

            <b-card
              title="Title"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
            >
              <b-card-text>This is a wider card with supporting text below as a natural lead-in to additional content.</b-card-text>
              <template v-slot:footer>
                <small class="text-muted">
                  <i class="fas fa-map-marker-alt"></i>
                  Hà Nội
                </small>
              </template>
            </b-card>
          </b-card-group>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      reviews: []
    };
  }
};
</script>
<style lang="css" scoped>
.card-body,
.card-footer {
  padding: 0.75rem;
}
.card-footer {
  background-color: #fff;
}
</style>