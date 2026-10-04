<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ColumnOptions from "@/features/demoTable/components/ColumnOptions.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import SampleColumns from "@/features/demoTable/components/SampleColumns.vue";
import SampleData from "@/features/demoTable/components/SampleData.vue";
import TableColumns from "@/features/demoTable/components/TableColumns.vue";
import TableExampleAdvanced from "@/features/demoTable/components/TableExampleAdvanced.vue";
import TableExampleBasic from "@/features/demoTable/components/TableExampleBasic.vue";
import TableReference from "@/features/demoTable/components/TableReference.vue";
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Fully functional and customizable table. Can sort and filter
                data as well as paginate.
            </p>
        </Card>
        <div class="flex flex-col lg:flex-row justify-center gap-2">
            <ExampleComponent title="Data Table Columns">
                <TableColumns />
            </ExampleComponent>
            <ExampleComponent title="Column Options">
                <ColumnOptions />
            </ExampleComponent>
        </div>
        <div class="flex flex-col lg:flex-row justify-center gap-2">
            <ExampleComponent title="Sample Columns">
                <SampleColumns />
            </ExampleComponent>
            <ExampleComponent title="Sample Data">
                <SampleData />
            </ExampleComponent>
        </div>
        <div class="flex flex-col gap-2">
            <ExampleComponent title="Basic Component Example">
                <TableExampleBasic />
            </ExampleComponent>
            <ExampleComponent title="Advanced Component Example">
                <TableExampleAdvanced />
            </ExampleComponent>
            <Card title="Component Reference">
                <TableReference />
            </Card>
        </div>
    </div>
</template>
