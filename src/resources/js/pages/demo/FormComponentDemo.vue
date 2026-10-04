<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import TextInput from "@/core/forms/components/validatedInputs/TextInput.vue";
import VueForm from "@/core/forms/components/VueForm.vue";
import { object, string } from "yup";

const initialValues = {
    text_input: "",
};

const validationSchema = object({
    text_input: string().required().label("Text Input"),
});
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                The Form Component is a wrapper and form builder. Individual
                input components are placed inside the wrapper to build the form
                UI. The wrapper handles the form logic including form
                submission. The input components include validation styling.
            </p>
            <p class="text-center">
                Validation is done via the Yup Validation library to define
                validation rules, and Vee-Validate to handle validation logic.
            </p>
        </Card>
        <Card title="Basic Form Example">
            <div>
                <VueForm
                    name="basic-demo-form"
                    submit-method="post"
                    submit-route="/submit-form"
                    :initial-values="initialValues"
                    :validation-schema="validationSchema"
                >
                    <TextInput name="text_input" label="Required Text Input" />
                </VueForm>
            </div>
        </Card>
    </div>
</template>
