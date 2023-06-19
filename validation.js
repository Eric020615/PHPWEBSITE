const validation = new JustValidate("#sign-up");
validation.addField("#email",[
            {
                rule: "required"
            },
            {
                rule: "email"
            },
            {
                // custom rules, value is the value get from email input
                validator: (value) => () =>{
                    // when user type somethings
                    // it will create a http request
                    return fetch("validate-email.php?email="+encodeURIComponent(value))
                        .then(function(response){
                            return response.json();
                        })
                        .then(function(json){
                            return json.available;
                        })
                },
                errorMessage : "email already taken"
            }
            ])
            .addField("#phone_num", [{
                rule: "required"
            }])
            .addField("#password",[
                {
                    rule: "required"
                },
                {
                    rule: "password"
                }
            ])
            .onSuccess((event)=>{
                document.getElementById("sign-up").submit();
            })