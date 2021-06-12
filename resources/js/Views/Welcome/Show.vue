<template>
    <auth-layout>
        <template #left>
            <advertisement></advertisement>
        </template>

        <template #right>
            <div class="max-w-xl">
                <div>
                    <div class="mb-6 block lg:hidden">
                        <logo :title="config('app.name')" classes="h-8 w-auto text-gray-800"></logo>
                    </div>

                    <h4 class="mt-6 font-semibold text-xl text-gray-800">
                        Splitting the bill just got easier.
                    </h4>
                </div>

                <div class="mt-3">
                    <form @submit.prevent="calculateBill" class="w-full">
                        <div>
                            <p class="font-normal text-base text-gray-500">
                                Type in properly formatted bill records containing infromation on total amount paid, friends gathered and person who paid the bill on that day.
                            </p>
                        </div>

                        <div class="mt-6 block">
                            <app-textarea label="Billing records in JSON format" placeholder="Billing records" v-model="form.bill" :error="form.errors.bill"></app-textarea>
                        </div>

                        <div class="mt-3">
                            <span class="text-xs font-semibold text-gray-500">Only use valid JSON format</span>
                        </div>

                        <section-border span="5"></section-border>

                        <div>
                            <p class="font-normal text-base text-gray-500">
                                Or, you may upload a <span class="font-semibold text-sm rounded-md bg-gray-100 text-gray-600 px-2 py-px">.txt</span> or <span class="font-semibold text-sm rounded-lg bg-gray-100 text-gray-600 px-2 py-px">.json</span> file containing the billing records and we'll take care of everything else.
                            </p>
                        </div>

                        <div class="mt-6 block">
                            <input type="file" class="hidden" ref="billfile" @change="hasFile = true">

                            <app-button type="button" mode="secondary" @click.prevent="selectBillFile">
                                Upload billing records file
                            </app-button>

                            <app-input-error :message="form.errors.billfile" class="mt-4"></app-input-error>
                        </div>

                        <section-border span="5"></section-border>

                        <div class="flex items-center justify-end" v-show="hasContent()">
                            <action-message :on="form.recentlySuccessful" class="mr-4">
                                Calculation completed. <span class="mr-1">&check;</span>
                            </action-message>

                            <app-button type="submit" mode="primary" :class="{ 'opacity-25': form.processing }" :loading="form.processing">
                                Calculate bill <span class="ml-1">&rarr;</span>
                            </app-button>
                        </div>

                        <div class="mt-6">
                            <p>
                                Still confused? check out our <app-link :href="route('guide')">usage guide</app-link>.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </auth-layout>
</template>

<script>
import AuthLayout from "@/Views/Layouts/AuthLayout";
import AppLink from "@/Views/Components/Base/Link";
import AppInput from '@/Views/Components/Inputs/Input';
import AppInputError from '@/Views/Components/Inputs/InputError';
import AppTextarea from '@/Views/Components/Inputs/Textarea';
import AppButton from '@/Views/Components/Buttons/Button';
import Checkbox from '@/Views/Components/Inputs/Checkbox';
import Logo from '@/Views/Components/Logos/Logo';
import SectionBorder from '@/Views/Components/Sections/SectionBorder';
import ActionMessage from '@/Views/Components/Alerts/ActionMessage';
import Advertisement from '@/Views/Auth/Advertisement';

export default {
    components: {
        AuthLayout,
        AppLink,
        AppInput,
        AppInputError,
        AppTextarea,
        AppButton,
        Checkbox,
        Logo,
        SectionBorder,
        ActionMessage,
        Advertisement,
    },

    props: {
        details: {
            type: Object,
            required: false
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                bill: null,
                billfile: null
            }),

            hasFile: false
        }
    },

    methods: {
        calculateBill() {
            if (this.$refs.billfile) {
                this.form.billfile = this.$refs.billfile.files[0];
            }

            this.form.post(this.route('bills.store'), {
                errorBag: 'calculateBill',
                preserveScroll: true,
                onSuccess: () => {
                    this.clearBillFileInput();
                },
            }, {
                resetOnSuccess: true
            });
        },

        selectBillFile() {
            this.$refs.billfile.click();
        },

        clearBillFileInput() {
            if (this.$refs.billfile?.value) {
                this.$refs.billfile.value = null;
            }
        },

        hasContent() {
            return this.form.bill || this.hasFile;
        }
    }
};
</script>
