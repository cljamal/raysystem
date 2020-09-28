@extends( $template . 'layouts.app')

@push('title', 'Добро пожаловать')

@section('content')
    <v-app>
        <v-main>
            <v-card
                class="d-flex align-center justify-center mb-6"
                color="grey lighten-2"
                flat
                height="100vh"
                tile
            >
                <v-card class="pa-2"    >
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <v-text-field
                            v-model="name"
                            :counter="10"
                            :rules="nameRules"
                            label="Name"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="email"
                            :rules="emailRules"
                            label="E-mail"
                            required
                        ></v-text-field>

                        <v-select
                            v-model="select"
                            :items="items"
                            :rules="[v => !!v || 'Item is required']"
                            label="Item"
                            required
                        ></v-select>

                        <v-checkbox
                            v-model="checkbox"
                            :rules="[v => !!v || 'You must agree to continue!']"
                            label="Do you agree?"
                            required
                        ></v-checkbox>

                        <v-btn
                            :disabled="!valid"
                            color="success"
                            class="mr-4"
                            @click="validate"
                        >
                            Validate
                        </v-btn>

                        <v-btn
                            color="error"
                            class="mr-4"
                            @click="reset"
                        >
                            Reset Form
                        </v-btn>

                        <v-btn
                            color="warning"
                            @click="resetValidation"
                        >
                            Reset Validation
                        </v-btn>
                    </v-form>
                </v-card>
            </v-card>
        </v-main>
    </v-app>
@endsection


@push('footer')
    <script>
        mixin.push({
            data: () => ({
                valid: true,
                name: '',
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 10) || 'Name must be less than 10 characters',
                ],
                email: '',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
                select: null,
                items: [
                    'Item 1',
                    'Item 2',
                    'Item 3',
                    'Item 4',
                ],
                checkbox: false,
            }),

            methods: {
                validate () {
                    this.$refs.form.validate()
                },
                reset () {
                    this.$refs.form.reset()
                },
                resetValidation () {
                    this.$refs.form.resetValidation()
                },
            },
        })

    </script>
@endpush
