export default () => {
    const googleMap = document.getElementById('googleMap');

    if (googleMap) {
        const { coordinates, key } = JSON.parse(googleMap.getAttribute('data-initData'));

        const scriptRecaptcha = document.createElement('script');
        scriptRecaptcha.src = `https://maps.googleapis.com/maps/api/js?key=${key}&callback=initMap`;
        document.head.appendChild(scriptRecaptcha);

        window.initMap = function () {
            new window.google.maps.Marker({
                position: coordinates,
                map: new window.google.maps.Map(googleMap, {
                    zoom: 17,
                    center: coordinates,
                }),
            });
        };
    }
}
