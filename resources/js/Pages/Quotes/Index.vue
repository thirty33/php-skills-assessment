<script setup>
import { reactive, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({ quotes: Array });

const itemsPerRequest = 3;

const getRandom = () => {
  router.get(
    route("quotes.index"),
    { amout: itemsPerRequest },
    { preserveState: true }
  );
};

const addFavorite = (id) => {
  router.post(route("quotes.favorite"), {
    quote_id: id,
  });
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
											@click.prevent="() => addFavorite(quote.id)">
                      <svg
                        class="w-4 h-4 mr-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 000-6.364A4.5 4.5 0 0012 6.318z"
                        />
                      </svg>
                      <span class="hidden sm:inline">Favorite</span>
                    </a>
                  </td>
                </tr>
              </table>
              <hr class="my-3" />
              <PrimaryButton @click.prevent="getRandom">
                Random quotes
              </PrimaryButton>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
