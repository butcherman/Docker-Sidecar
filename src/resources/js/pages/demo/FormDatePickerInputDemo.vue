<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseDatePickerInput from "@/core/forms/components/baseInputs/BaseDatePickerInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const dateValue = ref("");

const referenceProperties = [
    {
        property: "name",
        type: "string",
        default: "",
        required: true,
        description: "Name of input",
    },
    {
        property: "value",
        type: "unknown",
        default: "",
        required: true,
        description: "Value bound to input using v-bind",
    },
    {
        property: "autocomplete",
        type: "string",
        default: "",
        required: false,
        description: "Autocomplete attribute for the input",
    },
    {
        property: "disabled",
        type: "boolean",
        default: "false",
        required: false,
        description: "Disable the input",
    },
    {
        property: "errorMessage",
        type: "string",
        default: "",
        required: false,
        description: "Error message when input is invalid",
    },
    {
        property: "helpMessage",
        type: "string",
        default: "",
        required: false,
        description: "Help message to show under input",
    },
    {
        property: "helpVisible",
        type: "boolean",
        default: "false",
        required: false,
        description:
            "When true, help will always be visible, not just when has focus.",
    },
    {
        property: "label",
        type: "string",
        default: "",
        required: false,
        description: "Label for the input",
    },
    {
        property: "placeholder",
        type: "string",
        default: "",
        required: false,
        description: "Placeholder Text",
    },
    {
        property: "variant",
        type: "filled | outlined | standard",
        default: "outlined",
        required: false,
        description: "Style of the input",
    },
];

const slotProperties = [
    {
        name: "prepend-input",
        params: "",
        description: "Prepends the input with bordered data",
    },
    {
        name: "append-input",
        params: "",
        description: "Appends the input with bordered data",
    },
];

const emitProperties = [
    {
        name: "focus",
        params: "",
        description: "Triggered when input gains focus",
    },
    {
        name: "blur",
        params: "",
        description: "Triggered when an input looses focus",
    },
    {
        name: "change",
        params: "string",
        description: "When the value changes, that value is emitted.",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Date Picker Input</h3>
            <p class="text-center">Easily select a calendar date.</p>
        </Card>
        <ExampleComponent>
            <template #component>
                <BaseDatePickerInput
                    v-model="dateValue"
                    name="date_picker"
                    label="Select A Date"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseDatePickerInput from
                "@/core/forms/components/baseInputs/BaseDatePickerInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseDatePickerInput<br />
                &emsp;&emsp;v-model="dateValue"<br />
                &emsp;&emsp;name="date_picker"<br />
                &emsp;&emsp;label="Select A Date"<br />
                &emsp;/BaseDatePickerInput&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
            :emit-properties="emitProperties"
        />
    </div>
</template>
