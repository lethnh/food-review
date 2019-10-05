<template>
  <div>
    <section>
      <div class="section-title">
        <h3>Cửa hàng review nhiều nhất</h3>
      </div>
      <div class="section-content m-t-20">
        <div>
          <b-card-group deck>
            <b-card
              title="Title"
              img-src="https://picsum.photos/300/300/?image=41"
              img-alt="Image"
              img-top
              class="position-relative"
            >
              <span class="card-dot"></span>
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
export default {};
</script>
<style lang="css" scoped>
.card-body,
.card-footer {
  padding: 0.75rem;
}
.card-dot{
	height: 15px;
	width: 15px;
	border-radius: 50%;
	background-color: lawngreen;
	position:absolute;
	top: -5px;
    left: -5px;
}
</style>