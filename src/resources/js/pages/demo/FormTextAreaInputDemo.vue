<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseTextAreaInput from "@/core/forms/components/baseInputs/BaseTextAreaInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

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
];

const inputValue = ref("");
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Text Area Input</h3>
            <p class="text-center">Basic Text Input</p>
        </Card>
        <ExampleComponent title="Basic Example" show>
            <template #component>
                <BaseTextAreaInput
                    v-model="inputValue"
                    name="text_area"
                    label="Text Area Input"
                    placeholder="Test Input"
                    :rows="10"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseTextAreaInput from
                "@/core/forms/components/baseInputs/BaseTextAreaInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseTextAreaInput<br />
                &emsp;&emsp;v-model="textValue"<br />
                &emsp;&emsp;name="text_area"<br />
                &emsp;&emsp;label="Text Area Input"<br />
                &emsp;&emsp;placeholder="Test Input"<br />
                &emsp;&emsp;:rows="10"<br />
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
