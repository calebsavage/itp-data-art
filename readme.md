# Quick And Dirty Data Visualization
## World map visualizations with D3.js
### Normalizing the data (Excel)
Starting point: https://bl.ocks.org/mbostock/4180634
I started with some example code and an SVG of a world map from this site.

The countries on the map are indexed by its ISO 3166-1 code. In order to match the country names in the provided dataset on immigrants with the relevant ISO codes, I used the VLOOKUP function in Excel. I started by creating a sheet with the provided dataset, and another sheet with a list of countries and their ISO codes. 

The basic forumula I used is =VLOOKUP(A2,Sheet1!A:B,2,FALSE) where A2 is the name of the country I want to find the code for. Sheet1!A:B is the range of cells containing the country names and ISO codes. The third parameter ("2") indicates which column in the source dataset contains the ISO codes to grab. The last parameter ("FALSE") specifies that I want to only find an exact match.

The dataset has a number of geographic areas which don't map to a country, which for the purposes of this assignment I will ignore. 

I ended up with the following:

| country                                               | countrycode | estimate | marginOfError | 
|-------------------------------------------------------|-------------|----------|---------------| 
| Northern Europe                                       | #N/A        | 928644   | 16770         | 
| United Kingdom (inc. Crown Dependencies)              | #N/A        | 683473   | 13753         | 
| United Kingdom excluding England and Scotland         | #N/A        | 310243   | 9571          | 
| England                                               | #N/A        | 319734   | 9589          | 
| Scotland                                              | #N/A        | 53496    | 3645          | 
| Ireland                                               | 372         | 120144   | 6262          | 
| Denmark                                               | 208         | 29039    | 2609          | 
| Norway                                                | 578         | 24982    | 2645          | 
| Sweden                                                | 752         | 46335    | 3628          | 
| Other Northern Europe                                 | #N/A        | 24671    | 2648          | 
| Western Europe                                        | #N/A        | 964714   | 16839         | 
| Austria                                               | 40          | 43401    | 3026          | 
| Belgium                                               | 56          | 34232    | 2938          | 
| France                                                | 250         | 173561   | 8607          | 
| Germany                                               | 276         | 585298   | 12124         | 
| Netherlands                                           | 528         | 88580    | 6180          | 
| Switzerland                                           | 756         | 37115    | 3317          | 
| Other Western Europe                                  | #N/A        | 2527     | 776           | 
| Southern Europe                                       | #N/A        | 787767   | 16505         | 
| Greece                                                | 300         | 141325   | 6452          | 
| Italy                                                 | 380         | 352492   | 11766         | 
| Portugal                                              | 620         | 176803   | 8390          | 
| Azores Islands                                        | #N/A        | 27072    | 3439          | 
| Spain                                                 | 724         | 108953   | 6903          | 
| Other Southern Europe                                 | #N/A        | 8194     | 2545          | 
| Eastern Europe                                        | #N/A        | 2097040  | 29599         | 
| Albania                                               | 8           | 89744    | 9135          | 
| Belarus                                               | 112         | 56958    | 5339          | 
| Bulgaria                                              | 100         | 67377    | 5183          | 
| Croatia                                               | 191         | 36978    | 3546          | 
| Czechoslovakia (includes Czech Republic and Slovakia) | #N/A        | 66631    | 5112          | 
| Hungary                                               | 348         | 70255    | 5330          | 
| Latvia                                                | 428         | 21364    | 2476          | 
| Lithuania                                             | 440         | 31458    | 3872          | 
| Macedonia                                             | #N/A        | 26277    | 4621          | 
| Moldova                                               | #N/A        | 43564    | 5058          | 
| Poland                                                | 616         | 419332   | 12547         | 
| Romania                                               | 642         | 159546   | 7917          | 
| Russia                                                | #N/A        | 386529   | 13859         | 
| Ukraine                                               | 804         | 345620   | 11934         | 
| Bosnia and Herzegovina                                | 70          | 107969   | 9021          | 
| Serbia                                                | 688         | 36969    | 4673          | 
| Other Eastern Europe                                  | #N/A        | 130469   | 8453          | 
| Europe n.e.c.                                         | #N/A        | 11497    | 2703          | 
| Eastern Asia                                          | #N/A        | 4085872  | 43120         | 
| China                                                 | 156         | 2676697  | 35859         | 
| China excluding Hong Kong and Taiwan                  | #N/A        | 2065431  | 33869         | 
| Hong Kong                                             | 344         | 233373   | 7808          | 
| Taiwan                                                | #N/A        | 377893   | 12637         | 
| Japan                                                 | 392         | 335767   | 11198         | 
| Korea                                                 | #N/A        | 1060019  | 20054         | 
| Other Eastern Asia                                    | #N/A        | 13389    | 3024          | 
| South Central Asia                                    | #N/A        | 3797442  | 44695         | 
| Afghanistan                                           | 4           | 70653    | 6928          | 
| Bangladesh                                            | 50          | 228682   | 14479         | 
| India                                                 | 356         | 2389639  | 31113         | 
| Iran                                                  | #N/A        | 394223   | 14189         | 
| Kazakhstan                                            | 398         | 29859    | 3389          | 
| Nepal                                                 | 524         | 120886   | 8823          | 
| Pakistan                                              | 586         | 379435   | 17427         | 
| Sri Lanka                                             | 144         | 52971    | 5613          | 
| Uzbekistan                                            | 860         | 65375    | 5987          | 
| Other South Central Asia                              | #N/A        | 65719    | 7114          | 
| South Eastern Asia                                    | #N/A        | 4228958  | 40229         | 
| Cambodia                                              | 116         | 166268   | 9301          | 
| Indonesia                                             | 360         | 90833    | 7010          | 
| Laos                                                  | 418         | 197016   | 9812          | 
| Malaysia                                              | 458         | 69308    | 5119          | 
| Myanmar                                               | 104         | 137567   | 10011         | 
| Philippines                                           | 608         | 1982369  | 30007         | 
| Singapore                                             | 702         | 36252    | 3382          | 
| Thailand                                              | 764         | 247205   | 10349         | 
| Vietnam                                               | 704         | 1300515  | 27733         | 
| Other South Eastern Asia                              | #N/A        | 1625     | 673           | 
| Western Asia                                          | #N/A        | 1088369  | 22530         | 
| Iraq                                                  | 368         | 215193   | 13794         | 
| Israel                                                | 376         | 129680   | 6876          | 
| Jordan                                                | 400         | 81767    | 8063          | 
| Kuwait                                                | 414         | 31781    | 3643          | 
| Lebanon                                               | 422         | 119613   | 8361          | 
| Saudi Arabia                                          | 682         | 96783    | 8403          | 
| Syria                                                 | #N/A        | 82681    | 6286          | 
| Yemen                                                 | 887         | 44337    | 6088          | 
| Turkey                                                | 792         | 116336   | 8283          | 
| Armenia                                               | 51          | 86217    | 6658          | 
| Other Western Asia                                    | #N/A        | 83981    | 7429          | 
| Asia n.e.c.                                           | #N/A        | 48538    | 4922          | 
| Eastern Africa                                        | #N/A        | 612560   | 21605         | 
| Eritrea                                               | 232         | 39063    | 5274          | 
| Ethiopia                                              | 231         | 228745   | 13680         | 
| Kenya                                                 | 404         | 129905   | 10130         | 
| Somalia                                               | 706         | 89153    | 7277          | 
| Other Eastern Africa                                  | #N/A        | 125694   | 9018          | 
| Middle Africa                                         | #N/A        | 128584   | 11508         | 
| Cameroon                                              | 120         | 51172    | 7568          | 
| Other Middle Africa                                   | #N/A        | 77412    | 9776          | 
| Northern Africa                                       | #N/A        | 345832   | 15019         | 
| Egypt                                                 | 818         | 185872   | 11556         | 
| Morocco                                               | 504         | 71654    | 5503          | 
| Sudan                                                 | 729         | 46037    | 6708          | 
| Other Northern Africa                                 | #N/A        | 42269    | 4655          | 
| Southern Africa                                       | #N/A        | 98865    | 6281          | 
| South Africa                                          | 710         | 94141    | 5867          | 
| Other Southern Africa                                 | #N/A        | 4724     | 1384          | 
| Western Africa                                        | #N/A        | 766341   | 24249         | 
| Cabo Verde                                            | 132         | 43352    | 5264          | 
| Ghana                                                 | 288         | 155532   | 10846         | 
| Liberia                                               | 430         | 79497    | 7804          | 
| Nigeria                                               | 566         | 323635   | 18271         | 
| Sierra Leone                                          | 694         | 42065    | 5812          | 
| Other Western Africa                                  | #N/A        | 122260   | 9856          | 
| Africa n.e.c.                                         | #N/A        | 110075   | 9089          | 
| Australia and New Zealand Subregion                   | #N/A        | 113277   | 6339          | 
| Australia                                             | 36          | 83573    | 5527          | 
| Other Australian and New Zealand Subregion            | #N/A        | 29704    | 2990          | 
| Fiji                                                  | 242         | 41936    | 4822          | 
| Oceania n.e.c.                                        | #N/A        | 83450    | 6289          | 
| Latin America                                         | #N/A        | 22111409 | 88225         | 
| Caribbean                                             | #N/A        | 4165453  | 49473         | 
| Bahamas                                               | 44          | 34796    | 3735          | 
| Barbados                                              | 52          | 51739    | 4829          | 
| Cuba                                                  | 192         | 1210674  | 23840         | 
| Dominica                                              | 212         | 32370    | 4110          | 
| Dominican Republic                                    | 214         | 1063239  | 28770         | 
| Grenada                                               | 308         | 29982    | 3185          | 
| Haiti                                                 | 332         | 675546   | 22289         | 
| Jamaica                                               | 388         | 711134   | 19231         | 
| St. Vincent and the Grenadines                        | #N/A        | 22950    | 2820          | 
| Trinidad and Tobago                                   | 780         | 227295   | 8816          | 
| West Indies                                           | #N/A        | 33011    | 4485          | 
| Other Caribbean                                       | #N/A        | 72717    | 6064          | 
| Central America                                       | #N/A        | 15027927 | 80951         | 
| Mexico                                                | 484         | 11643298 | 77644         | 
| Belize                                                | 84          | 48811    | 5371          | 
| Costa Rica                                            | 188         | 90109    | 5646          | 
| El Salvador                                           | 222         | 1352357  | 31379         | 
| Guatemala                                             | 320         | 927593   | 23812         | 
| Honduras                                              | 340         | 599030   | 25695         | 
| Nicaragua                                             | 558         | 256171   | 12391         | 
| Panama                                                | 591         | 103625   | 5810          | 
| Other Central America                                 | #N/A        | 6933     | 1586          | 
| South America                                         | #N/A        | 2918029  | 40362         | 
| Argentina                                             | 32          | 181233   | 9339          | 
| Bolivia                                               | #N/A        | 78093    | 6898          | 
| Brazil                                                | 76          | 361374   | 15675         | 
| Chile                                                 | 152         | 95104    | 6986          | 
| Colombia                                              | 170         | 699399   | 20772         | 
| Ecuador                                               | 218         | 441257   | 19017         | 
| Guyana                                                | 328         | 281408   | 12349         | 
| Peru                                                  | 604         | 445921   | 17981         | 
| Uruguay                                               | 858         | 43971    | 5051          | 
| Venezuela                                             | #N/A        | 255520   | 13320         | 
| Other South America                                   | #N/A        | 34749    | 3674          | 
| Northern America                                      | #N/A        | 838476   | 17172         | 
| Canada                                                | 124         | 830628   | 17129         | 
| Other Northern America                                | #N/A        | 7848     | 1589          | 


