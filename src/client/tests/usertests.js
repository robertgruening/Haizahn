QUnit.module("Gruppe Users");
QUnit.config.reorder = false;

QUnit.test("PASSED: Benutzer speichern", function (assert) {
    var done = assert.async();

    $.ajax({
        method: "PUT",
        url: "../../server/services/user.php",
        data:
        {
            Name: "qunit",
            Email: "qunit@test.de",
            Password: "test",
            PasswordConfirmation: "test"
        },
        dataType: "JSON",
        success: function (data) {
            assert.ok(1 == 1, "Benutzer erfolgreich angelegt");
            done();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            assert.ok(2 == 1, "Benutzer nicht erfolgreich angelegt. Evtl. Benutzer vorher entfernen?");
            done();
        }
    });
}
);


QUnit.test("PASSED: Benutzer2 speichern", function (assert) {
    var done = assert.async();

    $.ajax({
        method: "PUT",
        url: "../../server/services/user.php",
        data:
        {
            Name: "qunit2",
            Email: "qunit2@test.de",
            Password: "test",
            PasswordConfirmation: "test"
        },
        dataType: "JSON",
        success: function (data) {
            assert.ok(1 == 1, "Benutzer2 erfolgreich angelegt");
            done();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            assert.ok(2 == 1, "Benutzer2 nicht erfolgreich angelegt. Evtl. Benutzer2 vorher entfernen?");
            done();
        }
    });
}
);


QUnit.test("FAILED: Benutzer existiert", function (assert) {
    var done = assert.async();

    $.ajax({
        method: "PUT",
        url: "../../server/services/user.php",
        data:
        {
            Name: "qunit",
            Email: "qunit@test.de",
            Password: "test",
            PasswordConfirmation: "test"
        },
        dataType: "JSON",
        success: function (data) {
            assert.ok(2 == 1, "Benutzer müsste bereits existieren. Benutzer vorher anlegen?");
            done();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 500) {
                if (jqXHR.responseJSON[0] == "Prüfe auf doppelte Einträge, siehe MySQL-Fehler 1062") {
                    assert.ok(1 == 1, "Benutzer schon vorhanden.");
                    done();
                }
                else {
                    assert.ok(2 == 1, "Nicht erwartete Fehlernachicht");
                    done();
                }
            }
            else {
                assert.ok(2 == 1, "Unbekanntes Problem.");
                done();
            }
        }
    });
}
);


QUnit.test("PASSED: Alle Benutzer laden", function (assert) {
    var done = assert.async();

    $.ajax({
        type: "GET",
        url: "../../server/services/user.php",
        dataType: "json",
        success: function (data, textStatus, jqXHR) {

            assert.ok(data != undefined, "Es ist definiert.");
            assert.ok(data != null, "Es ist nicht null.");
            assert.ok(Array.isArray(data), "Es ist ein Array.");
            assert.ok(data.length == 1, "Es gibt nur einen Benutzer.");
            done();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            assert.ok(2 == 1, "Benutzer nicht geladen");
            done();
        }
    });
}
);

QUnit.test("FAILED: Alle Benutzer laden leer", function (assert) {
    var done = assert.async();

    $.ajax({
        type: "GET",
        url: "../../server/services/user.php",
        dataType: "json",
        success: function (data, textStatus, jqXHR) {

            assert.ok(data != undefined, "Es ist definiert.");
            assert.ok(data != null, "Es ist nicht null.");
            assert.ok(Array.isArray(data), "Es ist ein Array.");
            assert.ok(data.length == 2, "Es gibt nur einen Benutzer.");
            done();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            assert.ok(2 == 1, "Benutzer nicht geladen");
            done();
        }
    });
}
);