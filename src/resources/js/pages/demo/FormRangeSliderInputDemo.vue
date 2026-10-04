<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseRangeSliderInput from "@/core/forms/components/baseInputs/BaseRangeSliderInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const rangeValue = ref("");

const referenceProperties = [
    {
        property: "name",
        type: "string",
        default: "",
        required: true,
        description: "Name of input",
    },
    {
        property: "min",
        type: "number",
        default: "",
        required: true,
        description: "Lowest number on the number line",
    },
    {
        property: "max",
        type: "number",
        default: "",
        required: true,
        description: "Highest number on the number line",
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
        property: "rangeVariant",
        type: "VariantType",
        default: "primary",
        required: false,
        description: "Color variant of the range input",
    },
    {
        property: "variant",
        type: "filled | outlined | standard",
        default: "outlined",
        required: false,
        description: "Style of the input",
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
        params: "[string]",
        description: "Triggered when the value is changed",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Range Slider Input</h3>
            <p class="text-center">Slider bar for numeric input.</p>
        </Card>
        <ExampleComponent show>
            <template #component>
                <BaseRangeSliderInput
                    v-model="rangeValue"
                    name="range_input"
                    label="Range Input"
                    value-text="You Selected"
                    :min="0"
                    :max="100"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseRangeSliderInput from
                "@/core/forms/components/baseInputs/BaseRangeSliderInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseRangeSliderInput<br />
                &emsp;&emsp;v-model="rangeValue"<br />
                &emsp;&emsp;name="range_input"<br />
                &emsp;&emsp;label="Range Input"<br />
                &emsp;&emsp;value-text="You Selected"<br />
                &emsp;&emsp;:min="0"<br />
                &emsp;&emsp;:max="100"<br />
                &emsp;/&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :emit-properties="emitProperties"
        />
    </div>
</template>
