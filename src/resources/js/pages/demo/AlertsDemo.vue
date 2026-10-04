<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BannerAlert from "@/core/components/alerts/BannerAlert.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { useAlertState } from "@/core/state/alertState";

const { pushFlashAlert, pushToastAlert } = useAlertState();

const demoVariants: VariantType[] = [
    "primary",
    "error",
    "danger",
    "help",
    "success",
    "warning",
    "dark",
    "info",
];

const demoFlash = () => {
    const variant =
        demoVariants[Math.floor(Math.random() * demoVariants.length)];

    pushFlashAlert({
        message: `I am a ${variant} alert`,
        variant,
    });
};

const demoToast = () => {
    pushToastAlert({
        title: "Toast Alert Title",
        message: "This is the toast Message",
        href: "/",
    });
};
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Collection of components for notifications.
            </p>
        </Card>
        <ExampleComponent title="Banner Alert">
            <template #component>
                <div class="flex flex-col w-full gap-2">
                    <BannerAlert
                        text="This is a Primary alert"
                        variant="primary"
                    />
                    <BannerAlert
                        text="This is a Danger alert"
                        variant="danger"
                    />
                    <BannerAlert
                        text="This is an Error alert"
                        variant="error"
                    />
                    <BannerAlert text="This is a Help alert" variant="help" />
                    <BannerAlert text="This is an Info alert" variant="info" />
                    <BannerAlert
                        text="This is a Success alert"
                        variant="success"
                    />
                    <BannerAlert
                        text="This is a Warning alert"
                        variant="warning"
                    />
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BannerAlert from
                "@/core/components/alerts/BannerAlert.vue" <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BannerAlert text="This is a Danger Alert"
                variant="danger" /&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="Flash Alert">
            <template #component>
                <p class="text-center mb-3">
                    Flash Alerts are part of the Layout and are pushed via
                    Laravel Flash, or manually via pushFlashAlert function in
                    the Alert State.
                </p>
                <div class="text-center mb-3">
                    <BaseButton
                        text="Click to show Flash Alert"
                        @click="demoFlash"
                    />
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import &lbrace; useAlertState &rbrace; from
                "@/core/state/alertState"; <br />
                <br />
                &emsp;const &lbrace; pushFlashAlert &rbrace; =
                userAlertState();<br />
                &emsp;const pushMsg = (msg, variant) => &lbrace;<br />
                &emsp;&emsp;&emsp;pushToastAlert(&lbrace;<br />
                &emsp;&emsp;&emsp;&emsp;message: msg;<br />
                &emsp;&emsp;&emsp;&emsp;variant: variant;<br />
                &emsp;&emsp;&emsp;&rbrace;);<br />
                &emsp;&rbrace;<br />
                &lt;/script&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="Toast Alert">
            <template #component>
                <p class="text-center mb-3">
                    Toast Alerts are part of the Layout and are pushed manually
                    via pushToastAlert function in the Alert State.
                </p>
                <div class="text-center mb-3">
                    <BaseButton
                        text="Click to show Toast Alert"
                        @click="demoToast"
                    />
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import &lbrace; useAlertState &rbrace; from
                "@/core/state/alertState"; <br />
                <br />
                &emsp;const &lbrace; pushToastAlert &rbrace; =
                useAlertState();<br />
                &emsp;const pushMsg = (msg, variant) => &lbrace;<br />
                &emsp;&emsp;&emsp;pushToastAlert(&lbrace;<br />
                &emsp;&emsp;&emsp;&emsp;message: msg;<br />
                &emsp;&emsp;&emsp;&emsp;variant: variant;<br />
                &emsp;&emsp;&emsp;&rbrace;);<br />
                &emsp;&rbrace;<br />
                &lt;/script&gt;<br />
            </template>
        </ExampleComponent>
    </div>
</template>
