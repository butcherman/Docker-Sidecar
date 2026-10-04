<script setup lang="ts">
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import GenericLayout from "@/layouts/GenericLayout.vue";

const props = defineProps<{}>();
</script>

<script lang="ts">
export default { layout: GenericLayout };
</script>
<template>
    <div class="flex justify-center items-center h-screen p-4">
        <Card title="Welcome" size="md">
            <p class="text-center">
                This is a base template built for new projects. It is highly
                opinionated (my opinion) and serves as a starting point for a
                new project. It includes a large number of pre-defined
                components. Most are completely custom, but some are wrappers of
                3rd party components.
            </p>
            <p class="text-center">
                Use the buttons below to browse the components and page
                templates.
            </p>
            <div class="flex justify-center gap-3 mt-4">
                <BaseButton text="Demo" href="/typography" />
            </div>
        </Card>
    </div>
</template>
