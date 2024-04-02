<script setup>
import { reactive, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({ users: Array });

const disableUser = (id) => {
  router.post(route("users.disable", id), { preserveState: true });
};
const enableUser = (id) => {
  router.post(route("users.enable", id), { preserveState: true });
};
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Module
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
          <div class="md:col-span-1">
            <div class="px-4 sm:px0">
              <h3 class="text-lg text-gray-900">Quote List</h3>
            </div>
          </div>
          <div class="md:col-span-2 mt-5 md:mt-0">
            <div class="shadow bg-while md:rounded-md p-4">
              <table>
                <tr v-for="user in users" :key="user.id">
                  <td class="border px-4 py-2">
                    <p>{{ user.name }}</p>
                  </td>
                  <td class="px-4 py-2 text-right">
                    <PrimaryButton 
                      v-if="!user.deleted_at"
                      @click.prevent="() => disableUser(user.id)">
                      Disable user
                    </PrimaryButton>
                    <PrimaryButton 
                      v-if="user.deleted_at"
                      @click.prevent="() => enableUser(user.id)">
                      Enable user
                    </PrimaryButton>
                  </td>
                </tr>
              </table>
              <hr class="my-3" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
