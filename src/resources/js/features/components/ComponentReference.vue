<script setup lang="ts">
import Card from "@/core/components/Card.vue";
import DataTable from "@/core/features/dataResources/DataTable.vue";
import { useReferenceHelper } from "@/features/composables/referenceHelper";

interface ReferenceProperties {
    property: string;
    type: string;
    default: string;
    required: boolean;
    description: string;
}

interface SlotProperties {
    name: string;
    params: string;
    description: string;
}

const props = defineProps<{
    referenceProperties?: ReferenceProperties[];
    slotProperties?: SlotProperties[];
    emitProperties?: SlotProperties[];
}>();

const { getPropColumns, getSlotColumns } = useReferenceHelper();
</script>

<template>
    <Card title="Component Reference">
        <div v-if="referenceProperties">
            <h4>Props</h4>
            <DataTable
                :columns="getPropColumns()"
                :data="referenceProperties"
            />
        </div>
        <div v-if="slotProperties">
            <h4>Slots</h4>
            <DataTable :columns="getSlotColumns()" :data="slotProperties" />
        </div>
        <div v-if="emitProperties">
            <h4>Emits</h4>
            <DataTable :columns="getSlotColumns()" :data="emitProperties" />
        </div>
    </Card>
</template>
