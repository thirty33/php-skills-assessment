<script setup>
import { reactive, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({ quotes: Array });

const deleteFavorite = (id) => {
  router.delete(route("quotes.favorites.delete", id), { preserveState: true });
};

</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Quote Module
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
                <tr v-for="quote in quotes" :key="quote.id">
                  <td class="border px-4 py-2">
                    <p>{{ quote.quote }}</p>
                    <p class="text-gray-500">- {{ quote.author }}</p>
                  </td>
                  <td class="px-4 py-2 text-right">
                    <a
                      v-if="!quote.favorite"
                      href=""
                      @click.prevent="() => deleteFavorite(quote.id)"
                    >
                      <span class="hidden sm:inline">Delete favorite</span>
                    </a>
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
