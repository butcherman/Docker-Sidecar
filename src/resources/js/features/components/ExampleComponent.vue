<script setup lang="ts">
import Card from "@/core/components/Card.vue";
import Collapse from "@/core/components/Collapse.vue";
import ExpandBadge from "@/core/components/badges/ExpandBadge.vue";
import { ref } from "vue";

const props = defineProps<{
    show?: boolean;
    title?: string;
}>();

const showExample = ref(props.show ?? false);
</script>

<template>
    <Card :title="title ?? 'Component Example'">
        <template #append-title>
            <ExpandBadge
                v-if="!show"
                :expanded="showExample"
                @click="showExample = !showExample"
            />
        </template>
        <Collapse :show="showExample || show">
            <slot>
                <div class="flex flex-col justify-center gap-2">
                    <slot name="component" />
                </div>
                <div class="mt-3 p-3 bg-slate-300 rounded-lg overflow-auto">
                    <slot name="code" />
                </div>
            </slot>
        </Collapse>
    </Card>
</template>
