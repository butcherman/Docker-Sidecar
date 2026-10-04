<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseOtpInput from "@/core/forms/components/baseInputs/BaseOtpInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const otpValue = ref("");

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
        property: "length",
        type: "number",
        default: "4",
        required: false,
        description: "Lenth of the OTP digits",
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
        description: "Triggered when the value changes",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">One Time Password (OTP) Input</h3>
            <p class="text-center">
                One Time Password input for handling Two Factor Authentication.
            </p>
        </Card>
        <ExampleComponent show>
            <template #component>
                <BaseOtpInput v-model="otpValue" name="otp_input" />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseOtpInput from
                "@/core/forms/components/baseInputs/BaseOtpInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseOtpInput<br />
                &emsp;&emsp;v-model="otpValue"<br />
                &emsp;&emsp;name="otp_input"<br />
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
