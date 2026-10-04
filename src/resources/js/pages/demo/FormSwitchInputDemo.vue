<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseSwitchInput from "@/core/forms/components/baseInputs/BaseSwitchInput.vue";
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
        type: "boolean",
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
        property: "switch-variant",
        type: "VariantType",
        default: "primary",
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
        params: "value:boolean",
        description: "Triggered when the input value changes",
    },
];

const inputValue = ref(true);
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Switch Input</h3>
            <p class="text-center">Toggle switch as a Checkbox Input</p>
        </Card>
        <ExampleComponent>
            <template #component>
                <BaseSwitchInput
                    v-model="inputValue"
                    name="switch_input"
                    label="Primary Variant"
                    switch-variant="primary"
                    error-message="This is an error message"
                    help-message="This is a help message"
                />
                <BaseSwitchInput
                    v-model="inputValue"
                    name="switch_input"
                    label="Success Variant"
                    switch-variant="success"
                    error-message="This is an error message"
                    help-message="This is a help message"
                />
                <BaseSwitchInput
                    v-model="inputValue"
                    name="switch_input"
                    label="Danger Variant"
                    switch-variant="danger"
                    error-message="This is an error message"
                    help-message="This is a help message"
                />
                <BaseSwitchInput
                    v-model="inputValue"
                    name="switch_input"
                    label="Warning Variant"
                    switch-variant="warning"
                    error-message="This is an error message"
                    help-message="This is a help message"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseSwitchInput from
                "@/core/forms/components/baseInputs/BaseSwitchInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseSwitchInput<br />
                &emsp;&emsp;v-model="boolValue"<br />
                &emsp;&emsp;name="switch_input"<br />
                &emsp;&emsp;label="Primary Variant"<br />
                &emsp;&emsp;error-message="This is an error message"<br />
                &emsp;&emsp;help-message="This is a help message"<br />
                &emsp;&emsp;switch-variant="primary"<br />
                &emsp;/BaseSwitchInput&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :emit-properties="emitProperties"
        />
    </div>
</template>
