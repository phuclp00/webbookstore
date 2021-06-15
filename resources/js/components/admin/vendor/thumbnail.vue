<template>
  <div fluid class="p-4 bg-dark">
    <p class="card-text text-danger">
      *Note: Uploading a new thumbnail will delete the old thumbnail , you can
      edit your picture in "Folder Manager > Books > books"
    </p>
    <b-button v-b-toggle.collapse-1 variant="primary"
      >Show List Thumbnail</b-button
    >
    <b-collapse id="collapse-1" class="mt-2">
      <b-card class="bg-secondary">
        <b-row>
          <b-col>
            <b-img
              class="thumb-book"
              v-for="item in thumbnail"
              :key="item"
              :src="'/' + item.image"
              thumbnail
              fluid
              :alt="item.description"
            ></b-img>
          </b-col>
        </b-row>
      </b-card>
    </b-collapse>
  </div>
</template>

<script>
export default {
  props: ["thumbnail"],
};
</script>

<style scoped>
.thumb-book {
  margin: 7px;
}
</style>