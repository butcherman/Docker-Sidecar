<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BasePhoneNumberInput from "@/core/forms/components/baseInputs/BasePhoneNumberInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const inputValue = ref("");

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
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Phone Number Input</h3>
            <p class="text-center">
                An input for showing a formatted phone number, but the value
                will just be the 10 digits
            </p>
        </Card>
        <ExampleComponent>
            <template #component>
                <BasePhoneNumberInput
                    v-model="inputValue"
                    name="phone_input"
                    label="Phone Number"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BasePhoneNumberInput from
                "@/core/forms/components/baseInputs/BasePhoneNumberInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BasePhoneNumberInput<br />
                &emsp;&emsp;v-model="inputValue"<br />
                &emsp;&emsp;name="phone_input"<br />
                &emsp;&emsp;label="Phone Number"<br />
                &emsp;/&gt;<br />
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
