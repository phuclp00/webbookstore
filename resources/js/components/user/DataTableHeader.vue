<template>
  <div class="row justify-content-between">
    <div class="col-sm-12 col-md-6">
      <div id="user_list_datatable_info" class="dataTables_filter">
        <form class="mr-3 position-relative">
          <div class="form-group mb-0">
            <input
              type="search"
              class="form-control"
              id="exampleInputSearch"
              placeholder="Search"
              aria-controls="user-list-table"
            />
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="user-list-files d-flex float-right">
        <a class="iq-bg-primary" href="javascript:void();"> Print </a>
        <a class="iq-bg-primary" href="javascript:void();"> Excel </a>
        <a class="iq-bg-primary" href="javascript:void();"> Pdf </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>